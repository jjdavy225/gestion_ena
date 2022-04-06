<?php

namespace App\Http\Controllers;

use App\Helpers\Helper;
use App\Http\Requests\CommandeRequest;
use App\Models\Agent;
use App\Models\Article;
use App\Models\Commande;
use App\Models\Fournisseur;
use App\Models\Marque;
use App\Models\Type;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commandes = Commande::all();
        return view('commande.index',compact('commandes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fournisseurs = Fournisseur::all();
        $agents = Agent::all();
        $articles = Article::all();
        $types = Type::all();
        $marques = Marque::all();
        return view('commande.create', compact('fournisseurs', 'agents', 'articles','types','marques'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CommandeRequest $request)
    {
        $commande = Commande::create([
            'num' => Helper::num_generator('Commande', date('Y' . '-' . 'm' . '-' . 'j'), Commande::select('num')->get()->last(),'num'),
            'date' => $request->date,
            'objet' => $request->objet,
            'num_fact' => $request->num_fact,
            'date_fact' => $request->date_fact,
            'remise' => $request->remise,
            'tva' => $request->tva,
            'montant' => $request->montant,              /* A calculer !!! */
            'delai_paie' => $request->delai_paie,
            'delai_liv' => $request->delai_liv,
            'date_liv' => $request->date_liv,
            'statut_liv' => 'Non livrée',
            'date_saisie' => date('Y' . '-' . 'm' . '-' . 'j'),
            'date_annul' => null,
            'fournisseur_id' => $request->fournisseur,
            'agent_id' => $request->agent,
            'frais' => $request->frais,
            'garantie' => $request->garantie,
        ]);

        $nb_article = count($request->articles);
        for ($i = 0; $i < $nb_article; $i++) {
            $commande->articles()->attach([
                $request->articles[$i] => [
                    'prix_unitaire' => $request->pu_s[$i],
                    'quantite' => $request->qtes[$i],
                    'quantite_livree' =>0,
                    'reste' => $request->qtes[$i],
                ]
            ]);
        }

        return redirect(route('commande.index'))->with('info','Commande enregistrée');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $commande = Commande::where('id','=',$id)->with('articles')->with('fournisseur')->get()->first();
        return view('commande.show',compact('commande'));
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
