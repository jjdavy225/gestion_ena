<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\FournisseurRequest;
use App\Models\Fournisseur;
use Illuminate\Http\Request;

class FournisseurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fournisseurs = Fournisseur::all();
        return view('fournisseur.index', compact('fournisseurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('fournisseur.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FournisseurRequest $request)
    {
        Fournisseur::create([
            'code' => Helper::num_generator('Fournisseur', date('Y' . '-' . 'm' . '-' . 'j'), Fournisseur::select('code')->get()->last(), 'code'),
            'sigle' => $request->sigle,
            'siege' => $request->siege,
            'adresse' => $request->adresse,
            'tel' => $request->tel,
            'fax' => $request->fax,
            'email' => $request->email,
            'site_web' => $request->site_web,
            'r_com' => $request->r_com,
            'ccont' => $request->ccont,
            'banque' => $request->banque,
            'compte' => $request->compte,
            'contact' => $request->contact,
            'activite' => $request->activite,
            'capital' => $request->capital,
            'regime_impot' => $request->regime_impot,
            'centre_impot' => $request->centre_impot,
        ]);
        return redirect(route('fournisseur.index'))->with('toast_success', 'Fournisseur créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $fournisseur = Fournisseur::find($id);
        return view('fournisseur.show',compact('fournisseur'));
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
