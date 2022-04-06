<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\InventaireRequest;
use App\Models\Inventaire;
use Illuminate\Http\Request;

class InventaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('inventaire.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('inventaire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(InventaireRequest $request)
    {
        $inventaire = Inventaire::create([
            'code' => Helper::num_generator('Inventaire',date('Y' . '-' . 'm' . '-' . 'j'),Inventaire::select('code')->get()->last(),'code'),
            'initial' =>$request->initial,
            'physique' =>$request->physique,
            'final' =>$request->final,
            'maj' =>$request->maj,
            'exercice_code' =>$request->exercice_code,
            'jour' => date('Y' . '-' . 'm' . '-' . 'j'),
            'nature' =>$request->nature,
        ]);


        return redirect(route('inventaire.index'))->with('info','L\'inventaire a été fait avec succès');
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
