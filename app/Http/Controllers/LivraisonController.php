<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\LivraisonRequest;
use App\Models\Agent;
use App\Models\Article;
use App\Models\Commande;
use App\Models\Livraison;
use App\Models\Stock;
use Illuminate\Http\Request;

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
        $agents = Agent::all();
        return view('livraison.create', compact('commandes', 'stocks', 'agents'));
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
            'code' => Helper::num_generator('Livraison', date('Y' . '-' . 'm' . '-' . 'j'), Livraison::select('code')->get()->last(), 'code'),
            'date' => $request->date,
            'remise' => $request->remise,
            'tva' =>  $request->tva,
            'montant' => $request->montant,
            'delai' => $request->delai,
            'date_saisie' => date('Y' . '-' . 'm' . '-' . 'j'),
            'commande_id' => $request->commande,
            'agent_id' => $request->agent,
            'stock_id' => $request->stock,
            'num_bon' => $request->num_bon,
            'date_bon' => $request->date_bon,
            'fact_num' => $request->fact_num,
            'fact_date' => $request->fact_date,
        ]);
        $commande = Commande::where('id', '=', $request->commande)->with('articles')->first();
        $articles = $commande->articles()->get();

        $stock = Stock::find($request->stock);
        if ($request->liv == 'complete') {
            $articles_r = $commande->articles()->get();
        }else {
            $articles_r = $request->articles;
        }
        $nb_article = count($articles_r);
        $complete = [];
        for ($i = 0; $i < $nb_article; $i++) {
            if ($request->liv == 'complete') {
                $id_r = $articles_r[$i]->id;
                $reste_r = $articles_r[$i]->pivot->reste;
            } else {
                $id_r = $request->articles[$i];
                $reste_r =$request->qtes[$i];
            }
            if ($reste_r > 0) {
                $stock->entree += 1;
                $stock->save();
                if ($stock->articles()->find($id_r) != null) {
                    $article_stock = $stock->articles()->find($id_r)->pivot;
                    $article_stock->quantite_article += $reste_r;
                    $article_stock->save();
                } else {
                    $stock->articles()->attach([
                        $id_r => [
                            'quantite_article' => $reste_r,
                            'mouvement' => 'entrée',
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
                $article->quantite_livree += $reste_r;
                $article->reste = $article->reste - $reste_r;
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
            $commande->statut_liv = 'Livrée';
            $commande->save();
        }else {
            $commande->statut_liv = 'Partielle';
            $commande->save();
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
        //
    }
}
