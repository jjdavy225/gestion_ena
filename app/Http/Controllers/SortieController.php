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
        return view('sortie.index', compact('sorties'));
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
            'statut' => 'S1S',
            'bureau_id' => Demande::find($request->demande)->bureau_id,
        ]);

        $demande = $sortie->demande;
        $articles = $demande->articles()->get();


        if ($request->type_sortie == 'complete') {
            $articlesSorties = $articles;
        } else {
            $articlesSorties = $request->articles;
        }

        $nb_article = count($articlesSorties);
        for ($i = 0; $i < $nb_article; $i++) {
            if ($request->type_sortie == 'complete') {
                $id_r = $articlesSorties[$i]->id;
                $reste_r = $articlesSorties[$i]->pivot->reste;
            } else {
                $id_r = $request->articles[$i];
                $reste_r = $request->qtes[$i];
            }

            $articleFound = false;
            foreach (Stock::all() as $stock) {
                $articleEnStock = $stock->articles()->find($id_r);
                if ($articleEnStock != null) {
                    $articleFound = true;
                    if ($articleEnStock->pivot->quantite_totale < $reste_r) {
                        $sortie->delete();
                        alert('Une erreur est survenue', 'Les quantités en stock sont insuffisantes pour cette opération !!', 'error');
                        return back();
                    }
                }
            }
            if (!$articleFound) {
                $sortie->delete();
                alert('Une erreur est survenue', 'Vérifier de bien avoir les articles en stocks !!', 'error');
                return back();
            }

            $article = $articles->find($id_r)->pivot;
            $sortie->articles()->attach([
                $id_r => [
                    'quantite_sortie' => $reste_r,
                    'reste' =>  $article->reste - $reste_r,
                ],
            ]);
        }


        return redirect(route('sortie.index'))->with('toast_success', 'Sortie enregistrée');
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
        return view('sortie.show', compact('sortie'));
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
        $sortie = Sortie::find($id);
        $sortie->articles()->detach();
        $sortie->delete();
        return back()->with('toast_success','Sortie supprimée avec succès');
    }

    public function validation(Request $request)
    {
        $request->validate([
            'sorties.*' => ['required', 'numeric'],
        ]);

        foreach ($request->sorties as $sortie_id) {
            $sortie = Sortie::find($sortie_id);
            $demande = $sortie->demande;
            $articles = $demande->articles()->get();

            $articlesSorties = $sortie->articles;
            $nb_article = count($articlesSorties);
            for ($i = 0; $i < $nb_article; $i++) {
                $id_r = $articlesSorties[$i]->id;
                $qteSortie = $articlesSorties[$i]->pivot->quantite_sortie;

                $articleFound = false;
                foreach (Stock::all() as $stock) {
                    $articleEnStock = $stock->articles()->find($id_r);
                    if ($articleEnStock != null) {
                        $articleFound = true;
                        if ($articleEnStock->pivot->quantite_totale < $qteSortie) {
                            alert('Une erreur est survenue', 'Les quantités en stock sont insuffisantes pour cette opération !!', 'error');
                            return back();
                        } else {
                            $articleEnStock->pivot->quantite_retournee -= $qteSortie;
                            if ($articleEnStock->pivot->quantite_retournee < 0) {
                                $articleEnStock->pivot->quantite_entree += $articleEnStock->pivot->quantite_retournee;
                                $articleEnStock->pivot->quantite_retournee = 0;
                            }
                            $articleEnStock->pivot->quantite_totale = $articleEnStock->pivot->quantite_entree + $articleEnStock->pivot->quantite_retournee;
                            $articleEnStock->pivot->save();
                            $stock->sortie += 1;
                            $stock->save();
                        }
                    }
                }
                if (!$articleFound) {
                    alert('Une erreur est survenue', 'Vérifier de bien avoir les articles en stocks !!', 'error');
                    return back();
                }

                $article = $articles->find($id_r)->pivot;
                $sortie->statut = 'S1V';
                $sortie->save();

                $article->quantite_sortie += $qteSortie;
                $article->reste -= $qteSortie;
                $article->save();

                $patrimoine = Patrimoine::where('bureau_id', '=', $sortie->bureau_id)->where('article_id', '=', $id_r)->first();
                if ($patrimoine == null) {
                    Patrimoine::create([
                        'bureau_id' => $sortie->bureau_id,
                        'article_id' => $id_r,
                        'quantite' => $qteSortie,
                    ]);
                } else {
                    $patrimoine->quantite += $qteSortie;
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
                $demande->statut = 'D1T';
                $demande->save();
            } else {
                $demande->statut = 'D1P';
                $demande->save();
            }
        }

        return back()->with('toast_success', 'Sorties validées');
    }
}
