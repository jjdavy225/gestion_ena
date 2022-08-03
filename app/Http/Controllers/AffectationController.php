<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Affectation;
use App\Models\Conducteur;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AffectationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $affectations = Affectation::all();
        return view('affectation.index', compact('affectations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $conducteurs = Conducteur::all();
        $vehicules = Vehicule::where('affecte',0)->get();
        return view('affectation.create', compact('vehicules', 'conducteurs'));
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
            'conducteur_principal' => 'required|numeric|min:0|unique:affectations,conducteur_principal_id',
            'vehicule' => 'bail|required|numeric|min:0',
            'conducteur_secondaire' => 'bail|nullable|numeric|min:0|different:conducteur_principal|unique:affectations,conducteur_secondaire_id',
            'date_debut' => 'bail|required|date',
            'date_fin' => 'bail|required|date|after:date_debut',
            'direction' => 'nullable|max:20',
            'service' => 'nullable|max:20',
        ]);

        Affectation::create([
            'code' => Helper::num_generator('Affectation', date('Y-m-j'), Affectation::select('code')->get()->last(), 'code'),
            'date_debut' => $request->date_debut,
            'date_fin_prevue' => $request->date_fin,
            'vehicule_id' => $request->vehicule,
            'conducteur_principal_id' => $request->conducteur_principal,
            'conducteur_secondaire_id' => $request->conducteur_secondaire,
            'direction' => $request->direction,
            'service' => $request->service,
            'statut' => 'A1S',
            'agent_id' => Auth::user()->agent->id,
        ]);

        return redirect()->route('affectation.index')->with('toast_success', 'Affectation éffectuée avec succès !!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $affectation = Affectation::find($id);
        return view('affectation.show', compact('affectation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $affectation = Affectation::find($id);
        if ($affectation->statut == 'A1V') {
            return back()->with('toast_info', 'Affectation déjà validée, impossible de la modifier !');
        } else {
            $conducteurs = Conducteur::all();
            $vehicules = Vehicule::all();
            return view('affectation.edit', compact('affectation', 'conducteurs', 'vehicules'));
        }
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
        $affectation = Affectation::find($id);
        if ($affectation->statut == 'A1V') {
            return redirect(route('affectation.index'))->with('toast_info', 'Affectation déjà validée, impossible de la modifier !');
        }

        $request->validate([
            'conducteur_principal' => ['required','numeric','min:0',Rule::unique('affectations','conducteur_principal_id',$affectation->conducteur_principal_id)],
            'vehicule' => 'bail|required|numeric|min:0',
            'conducteur_secondaire' => ['bail','nullable','numeric','min:0','different:conducteur_principal',Rule::unique('affectations','conducteur_secondaire_id',$affectation->conducteur_secondaire_id)],
            'date_debut' => 'bail|required|date',
            'date_fin' => 'bail|required|date|after:date_debut',
            'direction' => 'nullable|max:20',
            'service' => 'nullable|max:20',
        ]);

        $affectation->update([
            'date_debut' => $request->date_debut,
            'date_fin_prevue' => $request->date_fin,
            'vehicule_id' => $request->vehicule,
            'conducteur_principal_id' => $request->conducteur_principal,
            'conducteur_secondaire_id' => $request->conducteur_secondaire,
            'direction' => $request->direction,
            'service' => $request->service,
        ]);

        return redirect()->route('affectation.index')->with('toast_success', 'Affectation modifiée avec succès !!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $affectation = Affectation::find($id);
        if ($affectation->statut == 'A1V') {
            return back()->with('toast_error', 'Affectation déjà validée, suppression impossible!');
        } else {
            $affectation->delete();
            return back()->with('toast_success', 'Affectation supprimée avec succès');
        }
    }

    public function validation(Request $request)
    {
        $request->validate([
            'affectations.*' => 'required|numeric'
        ]);

        foreach ($request->affectations as $affectation) {
            $affectation = Affectation::find($affectation);
            if ($affectation->statut == 'A1S') {
                $vehicule = $affectation->vehicule;
                $vehicule->affecte = true;
                $vehicule->save();
            }
            $affectation->statut = 'A1V';
            $affectation->save();
        }
        return back()->with('toast_success', 'Affectations validées avec succès !');
    }
}
