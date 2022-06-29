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
        $livraison = Livraison::create([
            'code' => Helper::num_generator('Livraison', date('Y-m-j'), Livraison::select('code')->get()->last(), 'code'),
            'date' => $request->date,
            'remise' => $request->remise,
            'tva' =>  $request->tva,
            'montant' => $request->montant,
            'delai' => $request->delai,
            'date_saisie' => date('Y-m-j'),
            'commande_id' => $request->commande,
            'agent_id' => Auth::user()->agent->id,
            'stock_id' => $request->stock,
            'statut' => 'L1S',
            'num_bon' => $request->num_bon,
            'date_bon' => $request->date_bon,
            'fact_num' => $request->fact_num,
            'fact_date' => $request->fact_date,
        ]);

        $commande = $livraison->commande;
        $articles = $commande->articles()->get();

        if ($request->liv == 'complete') {
            $articlesR = $articles;
        }else {
            $articlesR = $request->articles;
        }
        $nb_article = count($articlesR);
        for ($i = 0; $i < $nb_article; $i++) {
            if ($request->liv == 'complete') {
                $id_r = $articlesR[$i]->id;
                $reste_r = $articlesR[$i]->pivot->reste;
            } else {
                $id_r = $request->articles[$i];
                $reste_r = $request->qtes[$i];
            }
            $articleLivree = $articles->find($id_r);
            if ($articleLivree == null) {
                $livraison->delete();
                return back()->with('error', 'Une erreur est survenue. Veuillez réessayer');
            } elseif ($articleLivree->pivot->quantite < $reste_r) {
                $livraison->delete();
                return back()->with('error', 'Vérifiez les quantités de la demande');
            } else {
                $livraison->articles()->attach([
                    $id_r => [
                        'quantite_livree' => $reste_r,
                        'prix_unitaire' => $articleLivree->pivot->prix_unitaire,
                        'reste' => $articleLivree->pivot->reste - $reste_r,
                    ]
                ]);
            }
        }

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
        $livraison = Livraison::find($id);
        $livraison->articles()->detach();
        $livraison->delete();
        return back()->with('info','Livraison supprimée avec succès');
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

            $articles_r = $livraison->articles;
            $nb_article = count($articles_r);
            $complete = [];
            for ($i = 0; $i < $nb_article; $i++) {
                $id_r = $articles_r[$i]->id;
                $qteLivree = $articles_r[$i]->pivot->quantite_livree;
                if ($qteLivree > 0) {
                    $stock->entree += 1;
                    $stock->save();
                    if ($stock->articles()->find($id_r) != null) {
                        $article_stock = $stock->articles()->find($id_r)->pivot;
                        $article_stock->quantite_entree += $qteLivree;
                        $article_stock->quantite_totale = $article_stock->quantite_entree + $article_stock->quantite_retournee;
                        $article_stock->save();
                    } else {
                        $stock->articles()->attach([
                            $id_r => [
                                'quantite_entree' => $qteLivree,
                                'quantite_retournee' => 00,
                                'quantite_totale' => $qteLivree,
                            ]
                        ]);
                    }
                    $livraison->statut = 'L1V';
                    $livraison->save();
                    $article = $articles->find($id_r)->pivot;
                    $article->quantite_livree += $qteLivree;
                    $article->reste -= $qteLivree;
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

        return back()->with('info', 'Livraisons validées');
    }
}
