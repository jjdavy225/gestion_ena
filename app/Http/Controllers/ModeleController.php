<?php

namespace App\Http\Controllers;

use App\Models\Modele;
use Illuminate\Http\Request;

class ModeleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $modeles = Modele::all();
        return view('modele.index', compact('modeles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('modele.create');
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
            'designation' => 'required|bail|max:25',
            'type_energie' => 'required|bail|max:25',
            'categorie' => 'required|bail|max:25'
        ]);

        Modele::create($request->all());

        return redirect()->route('modele.index')->with('toast_success','Modèle créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $modele = Modele::find($id);
        return view('modele.edit', compact('modele'));
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
            'designation' => 'required|bail|max:25',
            'type_energie' => 'required|bail|max:25',
            'categorie' => 'required|bail|max:25'
        ]);

        $modele = Modele::find($id);
        $modele->update($request->all());

        return redirect()->route('modele.index')->with('toast_success','Modèle modifié avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $modele = Modele::find($id);
        $modele->delete();
        return back()->with('toast_success','Modèle supprimé avec succès');
    }
}
