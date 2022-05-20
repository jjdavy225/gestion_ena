<?php

namespace App\Http\Controllers;

use App\Models\Patrimoine;
use Illuminate\Http\Request;

class PatrimoineController extends Controller
{
    public function index()
    {
        $patrimoines = Patrimoine::all();
        return view('patrimoine.index',compact('patrimoines'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        $patrimoine = Patrimoine::where('bureau_id','=',$id)->get();
        return view('patrimoine.show',compact('patrimoine'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
