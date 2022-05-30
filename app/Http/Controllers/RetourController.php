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
        return view('retour.index',compact('retours'));
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
            'bureau_id' => $request->bureau,
            'stock_id' => $request->stock,
            'agent_id' => Auth::user()->agent->id,
        ]);

        $stock = Stock::find($request->stock);
        $nb_article = count($request->articles);

        for ($i = 0; $i < $nb_article; $i++) {
            $articleEnStock = $stock->articles()->find($request->articles[$i]);
            if ($articleEnStock == null) {
                $stock->articles()->attach([
                    $request->articles[$i] => [
                        'quantite_entree' => 00,
                        'quantite_retournee' => $request->qtes[$i],
                        'quantite_totale' => $request->qtes[$i],
                    ]
                ]);
            }else {
                $articleEnStock->pivot->quantite_retournee += $request->qtes[$i];
                $articleEnStock->pivot->quantite_totale = $articleEnStock->pivot->quantite_retournee + $articleEnStock->pivot->quantite_entree ;
                $articleEnStock->pivot->save();
            }
            $stock->retour += 1;
            $stock->save();

            $patrimoine = Patrimoine::where('bureau_id', '=', $request->bureau)->where('article_id', '=', $request->articles[$i])->first();
            $patrimoine->quantite -= $request->qtes[$i];
            $patrimoine->save();

            $retour->articles()->attach([
                $request->articles[$i] => [
                    'quantite' => $request->qtes[$i],
                    'prix_unitaire' => 00,
                ]
            ]);
        }
        return 'Hello server';
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
        return view('retour.show',compact('retour'));
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
