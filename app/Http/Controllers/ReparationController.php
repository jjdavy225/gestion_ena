<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Models\Panne;
use App\Models\Reparation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReparationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reparations = Reparation::all();
        return view('reparation.index', compact('reparations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pannes = Panne::where('repare','0')->get();
        return view('reparation.create', compact('pannes'));
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
            'panne' => 'required|numeric|min:0',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0|max:100000000',
            'observation' => 'nullable|max:255',
            'agent_reparation' => 'required|max:30',
        ]);

        Reparation::create([
            'code' => Helper::num_generator('Reparation', date('Y-m-j'), Reparation::select('code')->get()->last(), 'code'),
            'panne_id' => $request->panne,
            'date' => $request->date,
            'montant' => $request->montant,
            'observation' => $request->observation,
            'agent_reparation' => $request->agent_reparation,
            'statut' => 'R1S',
            'agent_id' => Auth::user()->agent->id,
        ]);

        return redirect()->route('reparation.index')->with('toast_success', 'Réparation enregistrée avec succès !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reparation = Reparation::find($id);
        return view('reparation.show', compact('reparation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reparation = Reparation::find($id);
        if ($reparation->statut == 'R1S') {
            $pannes = Panne::where('repare','0')->get();
            return view('reparation.edit', compact('pannes', 'reparation'));
        } else {
            return back()->with('toast_info', 'Réparation déjà validée, donc non modifiable !');
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
        $request->validate([
            'panne' => 'required|numeric|min:0',
            'date' => 'required|date',
            'montant' => 'required|numeric|min:0|max:100000000',
            'observation' => 'nullable|max:255',
            'agent_reparation' => 'required|max:30',
        ]);

        $reparation = Reparation::find($id);
        $reparation->update([
            'panne_id' => $request->panne,
            'date' => $request->date,
            'montant' => $request->montant,
            'observation' => $request->observation,
            'agent_reparation' => $request->agent_reparation,
        ]);

        return redirect()->route('reparation.index')->with('toast_success', 'Réparation modifiée avec succès !');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reparation = Reparation::find($id);
        if ($reparation->statut == 'R1V') {
            return back()->with('toast_error', 'Réparation déjà validée, suppression impossible !');
        } else {
            $reparation->delete();
            return back()->with('toast_success', 'Réparation supprimée avec succès');
        }
    }

    public function validation(Request $request)
    {
        $request->validate([
            'reparations.*' => 'required|numeric'
        ]);

        foreach ($request->reparations as $reparation) {
            $reparation = Reparation::find($reparation);
            if ($reparation->statut == 'R1S') {
                $panne = $reparation->panne;
                $panne->repare = true;
                $panne->save();
                $panne->vehicule->dispo = true;
                $panne->vehicule->save();
            }
            $reparation->statut = 'R1V';
            $reparation->save();
        }
        return back()->with('toast_success', 'Réparations validées avec succès !');
    }
}
