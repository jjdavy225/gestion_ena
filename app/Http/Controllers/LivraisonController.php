<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\LivraisonRequest;
use App\Models\Agent;
use App\Models\Article;
use App\Models\Commande;
use App\Models\Inventaire;
use App\Models\Livraison;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LivraisonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $livraisons = Livraison::all();
        return view('livraison.index', compact('livraisons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $commandes = Commande::all();
        $stocks = Stock::all();
        return view('livraison.create', compact('commandes', 'stocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LivraisonRequest $request)
    {
        if ($request->liv != 'complete') {
            $json = [
                'articles' => $request->articles,
                'qtes' => $request->qtes,
            ];
            $json = json_encode($json);
        } else {
            $json = null;
        }
        Livraison::create([
            'code' => Helper::num_generator('Livraison', date('Y' . '-' . 'm' . '-' . 'j'), Livraison::select('code')->get()->last(), 'code'),
            'date' => $request->date,
            'remise' => $request->remise,
            'tva' =>  $request->tva,
            'montant' => $request->montant,
            'delai' => $request->delai,
            'date_saisie' => date('Y' . '-' . 'm' . '-' . 'j'),
            'commande_id' => $request->commande,
            'agent_id' => Auth::user()->agent->id,
            'stock_id' => $request->stock,
            'statut' => 'L1S',
            'num_bon' => $request->num_bon,
            'date_bon' => $request->date_bon,
            'fact_num' => $request->fact_num,
            'fact_date' => $request->fact_date,
            'type' => $request->liv,
            'json' => $json,
        ]);

        return redirect(route('livraison.index'))->with('info', 'Livraison enregistrée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $livraison = Livraison::find($id);
        return view('livraison.show', compact('livraison'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function validation(Request $request)
    {
        $request->validate([
            'livraisons.*' => ['required', 'numeric'],
        ]);

        foreach ($request->livraisons as $livraison_id) {
            $livraison = Livraison::find($livraison_id);
            $commande = Commande::find($livraison->commande_id);
            $articles = $commande->articles()->get();
            $stock = Stock::find($livraison->stock_id);

            $request = json_decode($livraison->json);

            if ( $livraison->type == 'complete') {
                $articles_r = $articles;
            } else {
                $articles_r = $request->articles;
            }
            $nb_article = count($articles_r);
            $complete = [];
            for ($i = 0; $i < $nb_article; $i++) {
                if ($livraison->type == 'complete') {
                    $id_r = $articles_r[$i]->id;
                    $reste_r = $articles_r[$i]->pivot->reste;
                } else {
                    $id_r = $request->articles[$i];
                    $reste_r = $request->qtes[$i];
                }
                if ($reste_r > 0) {
                    $stock->entree += 1;
                    $stock->save();
                    if ($stock->articles()->find($id_r) != null) {
                        $article_stock = $stock->articles()->find($id_r)->pivot;
                        $article_stock->quantite_entree += $reste_r;
                        $article_stock->quantite_totale = $article_stock->quantite_entree + $article_stock->quantite_retournee;
                        $article_stock->save();
                    } else {
                        $stock->articles()->attach([
                            $id_r => [
                                'quantite_entree' => $reste_r,
                                'quantite_retournee' => 00,
                                'quantite_totale' => $reste_r,
                            ]
                        ]);
                    }
                    $article = $articles->find($id_r)->pivot;
                    $livraison->articles()->attach([
                        $id_r => [
                            'quantite_livree' => $reste_r,
                            'prix_unitaire' => $article->prix_unitaire,
                            'reste' => $article->reste - $reste_r,
                        ]
                    ]);
                    $livraison->statut = 'L1V';
                    $livraison->json = null;
                    $livraison->save();
                    $article->quantite_livree += $reste_r;
                    $article->reste -= $reste_r;
                    $article->save();
                }
            }

            $stock->stock = count($stock->articles);
            $stock->save();

            foreach ($articles as $article) {
                if ($article->pivot->reste <= 0) {
                    $article->pivot->reste = 0;
                    $complete[] = true;
                } else {
                    $complete[] = false;
                }
            }

            $complete_v = true;
            foreach ($complete as $item) {
                if (!$item) {
                    $complete_v = false;
                    break;
                }
            }
            if ($complete_v) {
                $commande->statut_liv = 'C1T';
                $commande->save();
            } else {
                $commande->statut_liv = 'C1P';
                $commande->save();
            }

            $inventaire = Inventaire::create([
                'code' => Helper::num_generator('Inventaire', date('Y' . '-' . 'm' . '-' . 'j'), Inventaire::select('code')->get()->last(), 'code'),
                'exercice_code' => date('Y'),
                'jour' => date('Y' . '-' . 'm' . '-' . 'j'),
                'nature' => 'Inventaire après la livraison ' . $livraison->code,
            ]);

            foreach (Stock::all() as $stock) {
                foreach ($stock->articles as $article) {
                    $inventaire->articles()->attach([
                        $article->id => [
                            'quantite' => $article->pivot->quantite_totale,
                            'nature_stock' => $stock->nature,
                        ]
                    ]);
                }
            }
        }

        return back()->with('info','Livraisons validées');
    }
}
