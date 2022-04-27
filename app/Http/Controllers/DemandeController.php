<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\DemandeRequest;
use App\Models\Demande;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandes = Demande::all();
        return view('demande.index',compact('demandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stocks = Stock::all();
        return view('demande.create',compact('stocks'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DemandeRequest $request)
    {
        foreach (Stock::all() as $stock) {
            for ($i=0; $i < count($request->articles); $i++) {
                $id_article = $request->articles[$i]; 
                $articleEnStock = $stock->articles()->find($id_article);
                if ($articleEnStock != null) {
                    if ($articleEnStock->pivot->quantite_article < $request->qtes[$i]) {
                        return back()->with('errors_qte','Une erreur est survenue!  Vérifier les quantités saisies pour les articles !!');
                    }
                }
            }
        }
        $demande = Demande::create([
            'code' => Helper::num_generator('Demande', date('Y' . '-' . 'm' . '-' . 'j'), Demande::select('code')->get()->last(),'code'),
            'date' => $request->date,
            'objet' => $request->objet,
            'fiche' => $request->fiche,
            'delai' => $request->delai,
            'date_saisie' => date('Y' . '-' . 'm' . '-' . 'j'),
            'agent_id' => Auth::user()->agent->id,
            'code_secteur' => $request->code_secteur,
            'code_proprietaire' => $request->code_proprietaire,
            'statut' => 'Aucune sortie',
        ]);

        $nb_article = count($request->articles);
        for ($i = 0; $i < $nb_article; $i++) {
            $demande->articles()->attach([
                $request->articles[$i] => [
                    'quantite' => $request->qtes[$i],
                    'quantite_sortie' => 0,
                    'reste' => $request->qtes[$i],
                ]
            ]);
        }

        return redirect(route('demande.index'))->with('info','Demande enregistrée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demande = Demande::find($id);
        return view('demande.show',compact('demande'));
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
