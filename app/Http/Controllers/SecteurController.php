<?php

namespace App\Http\Controllers;

use App\Models\Secteur;
use Illuminate\Http\Request;
use App\Http\Resources\SecteurResource;
use App\Models\Offre;
class SecteurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $secteur = Secteur::limit(8)->with('offres')->get();
 
        
        return response([ 'secteurs' => new SecteurResource($secteur), 'message' => 'categorie Retrieved successfully'], 200);//
    }
    public function all()
    {
        $secteur = Secteur::all();
        
        return response([ 'secteurs' => new SecteurResource($secteur), 'message' => 'categorie Retrieved successfully'], 200);//
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function show(Secteur $secteur)
    {
        //
    }
public function SecteurWithOffre($id)
{
    $offres = Offre::where('secteur_id',$id)->get();
        $nbr_offres=$offres->count();
    	$secteurName = Secteur::where('id',$id)->first();
        return response()->json([
            "success" => true,
            "message" => "Categorie retrieved successfully.",
            "nom categorie"=>$secteurName,
            "offres" => $offres,
            "nbr_offres" =>$nbr_offres,
            ]);
}
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function edit(Secteur $secteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Secteur $secteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Secteur  $secteur
     * @return \Illuminate\Http\Response
     */
    public function destroy(Secteur $secteur)
    {
        //
    }
}
