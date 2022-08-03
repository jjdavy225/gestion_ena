<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Conducteur;
use App\Models\DemandeVehicule;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandeVehiculeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $demandeVehicules = DemandeVehicule::all();
        return view('demande_vehicule.index', compact('demandeVehicules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conducteurs = Conducteur::all();
        return view('demande_vehicule.create', compact('conducteurs'));
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
            'conducteur' => 'required|numeric|min:0',
            'objet' => 'required|max:50',
            'date_sortie' => 'required|date',
            'date_retour' => 'required|date|after:date_sortie',
        ]);

        DemandeVehicule::create([
            'code' => Helper::num_generator('Dvehicule', date('Y-m-j'), DemandeVehicule::select('code')->get()->last(), 'code'),
            'objet' => $request->objet,
            'conducteur_id' => $request->conducteur,
            'date_sortie' => $request->date_sortie,
            'date_retour' => $request->date_retour,
            'statut' => 'D1S',
            'agent_id' => Auth::user()->agent_id,
        ]);
        return redirect()->route('demande_vehicule.index')->with('toast_success', 'Demande de véhicule enregistrée avec succès !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demandeVehicule = DemandeVehicule::find($id);
        return view('demande_vehicule.show', compact('demandeVehicule'));
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
        $demandeVehicule = DemandeVehicule::find($id);
        if ($demandeVehicule->statut != 'D1S') {
            return back()->with('toast_error', 'Demande déjà validée, suppression impossible!');
        } else {
            $demandeVehicule->delete();
            return back()->with('toast_success', 'Demande supprimée avec succès');
        }
    }

    public function validation(Request $request)
    {
        $request->validate([
            'vehicule' => 'required|numeric|min:0',
            'demande' => 'required|numeric|min:0',
        ]);

        $demandeVehicule = DemandeVehicule::find($request->demande);
        $vehicule = Vehicule::find($request->vehicule);
        if ($demandeVehicule != null && $demandeVehicule->statut == 'D1S') {
            $demandeVehicule->kilometrage_depart = $vehicule->kilometrage;
            $demandeVehicule->vehicule_id = $vehicule->id;
            $demandeVehicule->statut = 'D1V';
            $demandeVehicule->save();
            $vehicule->dispo = false;
            $vehicule->save();

            return back()->with('toast_success', 'Demande de véhicule validée !');
        }else {
            return back()->with('toast_error','Une erreur s\'est produite !! Veuillez réassayer plus tard.');
        }

    }

    public function retour(Request $request)
    {
        $request->validate([
            'kilometrage_retour' => 'required|numeric|min:0',
            'demande' => 'required|numeric|min:0'
        ]);
        $demandeVehicule = DemandeVehicule::find($request->demande);
        if ($demandeVehicule != null && $demandeVehicule->statut == 'D1V') {
            $demandeVehicule->date_retour_reelle = date('Y-m-j');
            if ($demandeVehicule->kilometrage_depart > $request->kilometrage_retour) {
                return back()->with('toast_error','Une erreur s\'est produite !! Veuillez réassayer plus tard.');
            }
            $demandeVehicule->kilometrage_retour = $request->kilometrage_retour;
            $demandeVehicule->statut = 'D1R';
            $demandeVehicule->save();
            $vehicule = $demandeVehicule->vehicule;
            $vehicule->dispo = true;
            $vehicule->kilometrage = $request->kilometrage_retour;
            $vehicule->save();
            return back()->with('toast_success', 'Véhicule retourné !');
        }else {
            return back()->with('toast_error','Une erreur s\'est produite !! Veuillez réassayer plus tard.');
        }
    }
}
