<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\MouvementRequest;
use App\Models\Bureau;
use App\Models\Mouvement;
use App\Models\Patrimoine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MouvementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mouvements = Mouvement::all();
        return view('mouvement.index', compact('mouvements'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bureaux = Bureau::all();
        $patrimoines = Patrimoine::all();
        return view('mouvement.create', compact('patrimoines', 'bureaux'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MouvementRequest $request)
    {
        $mouvement = Mouvement::create([
            'code' => Helper::num_generator('Mouvement', date('Y-m-j'), Mouvement::select('code')->get()->last(), 'code'),
            'date' => $request->date,
            'date_saisie' => date('Y-m-j'),
            'observation' => $request->obs,
            'type' => $request->type,
            'agent_mouvement' => $request->agent_mouvement,
            'bureau_initial_id' => $request->bureau_initial,
            'bureau_final_id' => $request->bureau_final,
            'statut' => 'M1S',
            'agent_id' => Auth::user()->agent->id,
        ]);

        $nb_article = count($request->articles);
        for ($i = 0; $i < $nb_article; $i++) {
            $qteArticle = $request->qtes[$i];
            $patrimoineOrigine = Patrimoine::where('bureau_id', '=', $request->bureau_initial)->where('article_id', '=', $request->articles[$i])->first();
            if ($qteArticle >= $patrimoineOrigine->quantite) {
                $qteArticle = $patrimoineOrigine->quantite;
                $patrimoineOrigine->delete();
            } else {
                $patrimoineOrigine->quantite -= $qteArticle;
                $patrimoineOrigine->save();
            }

            $patrimoineDestination = Patrimoine::where('bureau_id', '=', $request->bureau_final)->where('article_id', '=', $request->articles[$i])->first();
            if ($patrimoineDestination == null) {
                $patrimoineDestination = Patrimoine::create([
                    'bureau_id' => $request->bureau_final,
                    'article_id' => $request->articles[$i],
                    'quantite' => $qteArticle,
                ]);
            } else {
                $patrimoineDestination->quantite += $qteArticle;
                $patrimoineDestination->save();
            }

            $mouvement->articles()->attach([
                $request->articles[$i] => [
                    'quantite' => $qteArticle,
                ]
            ]);
        }

        return redirect(route('mouvement.index'))->with('toast_success', 'Mouvement enregistré avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mouvement = Mouvement::find($id);
        return view('mouvement.show', compact('mouvement'));
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
        $mouvement = Mouvement::find($id);
        if ($mouvement->statut == 'M1S') {
            $mouvement->dettach();
            $mouvement->delete();
            return back()->with('toast_success', 'Mouvement supprimé avec succès');
        } else {
            alert('Suppression impossible', 'Cet élément a déja été validé !', 'error');
            return back();
        }
    }

    public function validation(Request $request)
    {
        $request->validate([
            'mouvements.*' => ['required', 'numeric']
        ]);

        foreach ($request->mouvements as $mouvement) {
            $mouvement = Mouvement::find($mouvement);
            foreach ($mouvement->articles as $article) {
                $qteArticle = $article->pivot->quantite;
                $patrimoineOrigine = Patrimoine::where('bureau_id', '=', $mouvement->bureau_initial_id)->where('article_id', '=', $article->id)->first();
                if ($qteArticle >= $patrimoineOrigine->quantite) {
                    $qteArticle = $patrimoineOrigine->quantite;
                    $patrimoineOrigine->delete();
                } else {
                    $patrimoineOrigine->quantite -= $qteArticle;
                    $patrimoineOrigine->save();
                }

                $patrimoineDestination = Patrimoine::where('bureau_id', '=', $mouvement->bureau_final_id)->where('article_id', '=', $article->id)->first();
                if ($patrimoineDestination == null) {
                    $patrimoineDestination = Patrimoine::create([
                        'bureau_id' => $mouvement->bureau_final_id,
                        'article_id' => $article->id,
                        'quantite' => $qteArticle,
                    ]);
                } else {
                    $patrimoineDestination->quantite += $qteArticle;
                    $patrimoineDestination->save();
                }
            }
            $mouvement->statut = 'M1V';
            $mouvement->save();
        }

        return back()->with('toast_success','Mouvements validés avec succès');
    }
}
