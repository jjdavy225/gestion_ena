<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\MarqueRequest;
use App\Models\Marque;
use Illuminate\Http\Request;

class MarqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $marques = Marque::all();
        return view('marque_article.index', compact('marques'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('marque_article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MarqueRequest $request)
    {
        Marque::create([
            'code' => Helper::num_generator('Marque', date('Y' . '-' . 'm' . '-' . 'j'), Marque::select('code')->get()->last(), 'code'),
            'designation' => $request->designation,
        ]);
        return redirect(route('marque_article.index'))->with('info', 'La marque a été renseignée avec succès');
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
        $marque = Marque::find($id);
        return view('marque_article.edit',compact('marque'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MarqueRequest $request, $id)
    {
        $marque = Marque::find($id);
        $marque->update($request->all());
        return redirect(route('marque_article.index'))->with('info','Marque modifiée avec succès');
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
