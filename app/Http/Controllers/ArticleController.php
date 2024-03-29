<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Marque;
use App\Models\Type;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::all();
        return view('article.index',compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        $marques = Marque::all();
        return view('article.create', compact('types', 'marques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleRequest $request)
    {
        if ($request->type == null) {
            $type = Type::create([
                'code' => Helper::num_generator('Type', date('Y-m-j'), Type::select('code')->get()->last(),'code'),
                'designation' => $request->newType
            ])->id;
        }else{
            $type = $request->type;
        }
        if ($request->marque == null) {
            $marque = Marque::create([
                'code' => Helper::num_generator('Marque', date('Y-m-j'), Marque::select('code')->get()->last(),'code'),
                'designation' => $request->newMarque
            ])->id;
        }else{
            $marque = $request->marque;
        }
        Article::create([
            'code' => Helper::num_generator('Article', date('Y-m-j'), Article::select('code')->get()->last(),'code'),
            'designation' => $request->designation,
            'type_id' => $type,
            'marque_id' => $marque,
        ]);
        return redirect(route('article.index'))->with('toast_success','Article créé avec succès');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $article = Article::where('id', '=', $id)->with('type')->with('marque')->get()->first();
        // return view('article.show', compact('article'));
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
