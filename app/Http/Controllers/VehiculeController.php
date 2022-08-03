<?php

namespace App\Http\Controllers;

use App\Models\Fournisseur;
use App\Models\MarqueVehicule;
use App\Models\Modele;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

class VehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vehicules = Vehicule::all();
        return view('vehicule.index', compact('vehicules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modeles = Modele::all();
        $marques = MarqueVehicule::all();
        $fournisseurs = Fournisseur::all();
        return view('vehicule.create', compact('marques', 'modeles', 'fournisseurs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'immatriculation' => 'required|bail|min:5|max:15|unique:vehicules,immatriculation',
            'carte_grise' => 'required|bail|min:5|max:15|unique:vehicules,carte_grise',
            'chassis' => 'required|bail|min:5|max:15|unique:vehicules,num_chassis',
            'date_circulation' => 'required|bail|date',
            'type_acquisition' => 'required|bail|alpha|max:25',
            'date_acquisition' => 'required|bail|date',
            'kilometrage' => 'numeric|nullable|min:0',
            'fournisseur' => 'required|bail|numeric',
            'modele' => 'required|bail|numeric',
            'marque' => 'required_if:newMarque,null|numeric',
            'newMarque' => 'max:30',
        ]);

        if ($request->newMarque != null) {
            $marque = MarqueVehicule::firstOrCreate(
                ['designation' => $request->newMarque]
            );
        } else {
            $marque = MarqueVehicule::find($request->marque);
        }

        Vehicule::create([
            'immatriculation' => $request->immatriculation,
            'carte_grise' => $request->carte_grise,
            'num_chassis' => $request->chassis,
            'date_mise_en_circulation' => $request->date_circulation,
            'type_acquisition' => $request->type_acquisition,
            'date_acquisition' => $request->date_acquisition,
            'kilometrage' => $request->kilometrage,
            'fournisseur_id' => $request->fournisseur,
            'modele_id' => $request->modele,
            'marque_vehicule_id' => $marque->id,
        ]);

        return redirect()->route('vehicule.index')->with('toast_success', 'Véhicule enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vehicule = Vehicule::find($id);
        return view('vehicule.show', compact('vehicule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modeles = Modele::all();
        $marques = MarqueVehicule::all();
        $fournisseurs = Fournisseur::all();
        $vehicule = Vehicule::find($id);
        return view('vehicule.edit', compact('vehicule','modeles','marques','fournisseurs'));
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
        $request->validate([
            'immatriculation' => 'required|bail|min:5|max:15',
            'carte_grise' => 'required|bail|min:5|max:15',
            'chassis' => 'required|bail|min:5|max:15',
            'date_circulation' => 'required|bail|date',
            'type_acquisition' => 'required|bail|alpha|max:25',
            'date_acquisition' => 'required|bail|date',
            'kilometrage' => 'numeric|nullable|min:0',
            'fournisseur' => 'required|bail|numeric',
            'modele' => 'required|bail|numeric',
            'marque' => 'required_if:newMarque,null|numeric',
            'newMarque' => 'max:30',
        ]);

        if ($request->newMarque != null) {
            $marque = MarqueVehicule::firstOrCreate(
                ['designation' => $request->newMarque]
            );
        } else {
            $marque = MarqueVehicule::find($request->marque);
        }

        $vehicule = Vehicule::find($id);
        $vehicule->update([
            'immatriculation' => $request->immatriculation,
            'carte_grise' => $request->carte_grise,
            'num_chassis' => $request->chassis,
            'date_mise_en_circulation' => $request->date_circulation,
            'type_acquisition' => $request->type_acquisition,
            'date_acquisition' => $request->date_acquisition,
            'kilometrage' => $request->kilometrage,
            'fournisseur_id' => $request->fournisseur,
            'modele_id' => $request->modele,
            'marque_vehicule_id' => $marque->id,
        ]);

        return redirect()->route('vehicule.index')->with('toast_success', 'Véhicule modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Vehicule::find($id)->delete();
        return back()->with('toast_success','Véhicule supprimé avec succès');
    }
}
