<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use App\Http\Requests\StoreCategorieRequest;
use App\Http\Requests\UpdateCategorieRequest;
use App\Models\Offre;
use App\Http\Resources\CategorieResource;
class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Categorie::all();
        return response([ 'categories' => CategorieResource::collection($categories), 'message' => 'categorie Retrieved successfully'], 200);
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
     * @param  \App\Http\Requests\StoreCategorieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategorieRequest $request)
    {
        $categorie = new Categorie();
        $categorie->nom = $request->nom;
        $categorie->save();//
        return response()->json([
            "success" => true,
            "message" => "Categorie created successfully.",
            ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        $categorie = Categorie::find($id);
        if (is_null($categorie)){
            return response()->json([
                "success" => false,
                "message" => "categorie non trouvée",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "categorie trouvée",
        "offre" => $categorie
        ]);
    }//
    public function showWithoffre($id)
    {
        $offres = Offre::where('categorie_id',$id)->paginate(20);
    	$categoryName = Categorie::where('id',$id)->first();
        return response()->json([
            "success" => true,
            "message" => "Categorie retrieved successfully.",
            "nom categorie"=>$categoryName,
            "offres" => $offres
            ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorie $categorie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategorieRequest  $request
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategorieRequest $request, $categorie_id)
    {
        $categorie = Categorie::Find($categorie_id);
        $categorie->nom = $request->nom;
        $categorie->save();//
        return response()->json([
            "success" => true,
            "message" => "Categorie updated successfully."
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Categorie  $categorie
     * @return \Illuminate\Http\Response
     */
    public function destroy($categorie_id)
    {
        $categorie = Categorie::Find($categorie_id);
        $categorie->delete();//
        return response()->json([
            "success" => true,
            "message" => "Categorie deleted successfully."
            ]);
    }
}
