<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Panne;
use App\Models\Vehicule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PanneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pannes = Panne::all();
        return view('panne.index', compact('pannes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $vehicules = Vehicule::all();
        return view('panne.create', compact('vehicules'));
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
            'vehicule' => 'required|numeric|min:0',
            'causes' => 'required|max:255',
            'observation' => 'nullable|max:255',
            'degats' => 'required|max:255',
            'date_panne' => 'required|date',
            'vehicule_utilisable' => 'required|boolean',
        ]);

        Panne::create([
            'code' => Helper::num_generator('Panne', date('Y-m-j'), Panne::select('code')->get()->last(), 'code'),
            'vehicule_id' => $request->vehicule,
            'vehicule_utilisable' => $request->vehicule_utilisable,
            'causes' => $request->causes,
            'observation' => $request->observation,
            'degats' => $request->degats,
            'date_panne' => $request->date_panne,
            'agent_id' => Auth::user()->agent_id,
            'statut' => 'P1S',
        ]);

        return redirect()->route('panne.index')->with('toast_success', 'Panne enregistrée avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $panne = Panne::find($id);
        return view('panne.show', compact('panne'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $panne = Panne::find($id);
        if ($panne->statut == 'P1V') {
            return back()->with('toast_info', 'Panne déjà validée, donc non modifiable !');
        } else {
            $vehicules = Vehicule::all();
            return view('panne.edit', compact('panne', 'vehicules'));
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
        $panne = Panne::find($id);
        if ($panne->statut == 'P1S') {
            return redirect(route('panne.index'))->with('toast_info', 'Panne déjà validée, donc non modifiable !');
        }

        $request->validate([
            'vehicule' => 'required|numeric|min:0',
            'causes' => 'required|max:255',
            'observation' => 'nullable|max:255',
            'degats' => 'required|max:255',
            'date_panne' => 'required|date',
            'vehicule_utilisable' => 'required|boolean',
        ]);

        $panne->update([
            'vehicule_id' => $request->vehicule,
            'vehicule_utilisable' => $request->vehicule_utilisable,
            'causes' => $request->causes,
            'observation' => $request->observation,
            'degats' => $request->degats,
            'date_panne' => $request->date_panne,
        ]);

        return redirect()->route('panne.index')->with('toast_success', 'Panne modifiée avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $panne = Panne::find($id);
        if ($panne->statut == 'P1V') {
            return back()->with('toast_error', 'Panne déjà validée, suppression impossible!');
        } else {
            $panne->delete();
            return back()->with('toast_success', 'Panne supprimée avec succès');
        }
    }

    public function validation(Request $request)
    {
        $request->validate([
            'pannes.*' => 'required|numeric'
        ]);

        foreach ($request->pannes as $panne) {
            $panne = Panne::find($panne);
            if ($panne->statut == 'P1S' && !$panne->vehicule_utilisable) {
                $vehicule = $panne->vehicule;
                $vehicule->dispo = false;
                $vehicule->save();
            }
            $panne->statut = 'P1V';
            $panne->save();
        }
        return back()->with('toast_success', 'Pannes validées avec succès !');
    }
}
