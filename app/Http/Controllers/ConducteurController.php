<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Conducteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ConducteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conducteurs = Conducteur::all();
        return view('conducteur.index', compact('conducteurs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $agents = Agent::all();
        return view('conducteur.create', compact('agents'));
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
            'agent_conducteur' => 'bail|numeric|min:0|unique:conducteurs,agent_conducteur_id',
            'numero_permis' => 'bail|required|max:20|unique:conducteurs,numero_permis',
            'type_permis' => 'bail|required|max:15',
            'validite_permis' => 'bail|required|date',
        ]);

        Conducteur::create([
            'agent_conducteur_id' => $request->agent_conducteur,
            'numero_permis' => $request->numero_permis,
            'type_permis' => $request->type_permis,
            'validite_permis' => $request->validite_permis,
            'agent_id' => Auth::user()->agent->id,
        ]);

        return redirect()->route('conducteur.index')->with('toast_success','Conducteur enregistré avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $conducteur = Conducteur::find($id);
        return view('conducteur.show', compact('conducteur'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $conducteur = Conducteur::find($id);
        $agents = Agent::all();
        return view('conducteur.edit', compact('conducteur','agents'));
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
        $conducteur = Conducteur::find($id);
        $request->validate([
            'agent_conducteur' => ['bail','numeric','min:0',Rule::unique('conducteurs','agent_conducteur_id')->ignore($conducteur->id)],
            'numero_permis' => ['bail','required','max:20',Rule::unique('conducteurs','numero_permis')->ignore($conducteur->id)],
            'type_permis' => 'bail|required|max:15',
            'validite_permis' => 'bail|required|date',
        ]);

        $conducteur->update([
            'agent_conducteur_id' => $request->agent_conducteur,
            'numero_permis' => $request->numero_permis,
            'type_permis' => $request->type_permis,
            'validite_permis' => $request->validite_permis,
        ]);

        return redirect()->route('conducteur.index')->with('toast_success','Conducteur modifié avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Conducteur::find($id)->delete();
        return back()->with('toast_success','Conducteur supprimé avec succès');
    }
}
