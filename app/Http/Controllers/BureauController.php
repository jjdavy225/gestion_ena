<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\BureauRequest;
use App\Models\Bureau;
use App\Models\Site;
use Illuminate\Http\Request;

class BureauController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bureaux = Bureau::all();
        return view('bureau.index',compact('bureaux'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sites = Site::all();
        return view('bureau.create',compact('sites'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BureauRequest $request)
    {
        Bureau::create([
            'code' => Helper::num_generator('Bureau', date('Y-m-j'), Bureau::select('code')->get()->last(),'code'),
            'designation' => $request->designation,
            'site_id' => $request->site,
        ]);

        return redirect(route('bureau.index'))->with('info','Nouveau bureau créé');
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
