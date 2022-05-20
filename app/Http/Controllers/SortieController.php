<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\SortieRequest;
use App\Models\Demande;
use App\Models\Patrimoine;
use App\Models\Sortie;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SortieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sorties = Sortie::all();
        return view('sortie.index',compact('sorties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $demandes = Demande::all();
        return view('sortie.create', compact('demandes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SortieRequest $request)
    {
        $sortie = Sortie::create([
            'code' => Helper::num_generator('Sortie', date('Y-m-j'), Sortie::select('code')->get()->last(), 'code'),
            'date' => $request->date,
            'heure' => date('H:i:s'),
            'date_saisie' => date('Y-m-j'),
            'demande_id' => $request->demande,
            'nature' => $request->nature,
            'agent_id' => Auth::user()->agent->id,
            'bureau_id' => Demande::find($request->demande)->bureau_id,
        ]);

        $demande = Demande::find($request->demande);
        $articles = $demande->articles()->get();

        if ($request->type_sortie == 'complete') {
            $articlesSorties = $articles;
        }else {
            $articlesSorties = $request->articles;
        }

        $nb_article = count($articlesSorties);
        for ($i=0; $i < $nb_article; $i++) { 
            if ($request->type_sortie == 'complete') {
                $id_r = $articlesSorties[$i]->id;
                $reste_r = $articlesSorties[$i]->pivot->reste;
            } else {
                $id_r = $request->articles[$i];
                $reste_r =$request->qtes[$i];
            }

            $articleFound = false;
            foreach (Stock::all() as $stock) {
                $articleEnStock = $stock->articles()->find($id_r);
                if ($articleEnStock != null) {
                    $articleFound = true;
                    if ($articleEnStock->pivot->quantite_article < $reste_r) {
                        $sortie->delete();
                        return back()->with('errors_qte','Les quantités en stock sont insuffisantes pour cette opération !!');
                    }else {
                        $articleEnStock->pivot->quantite_article -= $reste_r;
                        $articleEnStock->pivot->save();
                        $stock->sortie += 1;
                        $stock->save();
                    }
                }
            }
            if (!$articleFound) {
                $sortie->delete();
                return back()->with('errors_qte','Une erreur est survenue. Vérifier de bien avoir les articles en stocks !!');
            }

            $article = $articles->find($id_r)->pivot;
            $sortie->articles()->attach([
                $id_r =>[
                    'quantite_sortie' => $reste_r,
                    'reste' =>  $article->reste - $reste_r,
                ],
            ]);

            $article->quantite_sortie += $reste_r;
            $article->reste -= $reste_r;
            $article->save();

            $patrimoine = Patrimoine::where('bureau_id','=',$sortie->bureau_id)->where('article_id','=',$id_r)->first();
            if ($patrimoine == null) {
                Patrimoine::create([
                    'bureau_id' => $sortie->bureau_id,
                    'article_id' => $id_r,
                    'quantite' => $reste_r,
                ]);
            }else {
                $patrimoine->quantite += $reste_r;
                $patrimoine->save();
            }
        }

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
            $demande->statut = 'Sortie';
            $demande->save();
        }else {
            $demande->statut = 'Partielle';
            $demande->save();
        }

        return redirect(route('sortie.index'))->with('info', 'Sortie enregistrée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sortie = Sortie::find($id);
        return view('sortie.show',compact('sortie'));
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
