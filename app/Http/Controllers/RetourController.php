<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\RetourRequest;
use App\Models\Patrimoine;
use App\Models\Retour;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RetourController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $retours = Retour::all();
        return view('retour.index', compact('retours'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stocks = Stock::all();
        $patrimoines = Patrimoine::all();
        $bureaux = Patrimoine::distinct()->pluck('bureau_id');
        return view('retour.create', compact('patrimoines', 'bureaux', 'stocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RetourRequest $request)
    {
        $retour = Retour::create([
            'code' => Helper::num_generator('Retour', date('Y-m-j'), Retour::select('code')->get()->last(), 'code'),
            'date' => $request->date,
            'observation' => $request->obs,
            'date_saisie' => date('Y-m-j'),
            'statut' => 'R1S',
            'bureau_id' => $request->bureau,
            'stock_id' => $request->stock,
            'agent_id' => Auth::user()->agent->id,
        ]);

        $nb_article = count($request->articles);

        for ($i = 0; $i < $nb_article; $i++) {
            $retour->articles()->attach([
                $request->articles[$i] => [
                    'quantite' => $request->qtes[$i],
                    'prix_unitaire' => 00,
                ]
            ]);
        }
        return redirect()->route('retour.index')->with('toast_success', 'Retour éffectué avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $retour = Retour::find($id);
        return view('retour.show', compact('retour'));
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
        $retour = Retour::find($id);
        if ($retour->statut == 'R1S') {
            $retour->dettach();
            $retour->delete();
            return back()->with('toast_success', 'Retour supprimé avec succès');
        } else {
            alert('Suppression impossible', 'Cet élément a déja été validé !', 'error');
            return back();
        }
    }

    public function validation(Request $request)
    {
        $request->validate([
            'retours.*' => ['required', 'numeric']
        ]);

        foreach ($request->retours as $retour) {
            $retour = Retour::find($retour);
            $stock = $retour->stock;

            foreach ($retour->articles as $article) {
                $patrimoine = Patrimoine::where('bureau_id', '=', $retour->bureau_id)->where('article_id', '=', $article->id)->first();
                $patrimoine->quantite -= $article->pivot->quantite;
                if ($patrimoine->quantite <= 0) {
                    $article->pivot->quantite += $patrimoine->quantite;
                    $article->pivot->save();
                    $patrimoine->delete();
                } else {
                    $patrimoine->save();
                }

                $articleEnStock = $stock->articles()->find($article->id);
                if ($articleEnStock == null) {
                    $stock->articles()->attach([
                        $article->id => [
                            'quantite_entree' => 00,
                            'quantite_retournee' => $article->pivot->quantite,
                            'quantite_totale' => $article->pivot->quantite,
                        ]
                    ]);
                } else {
                    $articleEnStock->pivot->quantite_retournee += $article->pivot->quantite;
                    $articleEnStock->pivot->quantite_totale = $articleEnStock->pivot->quantite_retournee + $articleEnStock->pivot->quantite_entree;
                    $articleEnStock->pivot->save();
                }
                $stock->retour += 1;
                $stock->save();

            }

            $retour->statut = 'R1V';
            $retour->save();
        }

        return back()->with('toast_success', 'Retours validés avec succès');
    }
}
