<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Http\Requests\StoreOffreRequest;
use App\Http\Requests\UpdateOffreRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OffreResource;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $offres = Offre::all();
        return response([ 'offres' => OffreResource::collection($offres), 'message' => 'Retrieved successfully'], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!auth()->user()->role=='entreprise') {
            return response()->json(['error' => 'vous devez avoir un compte entreprise'], 404);
        }
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOffreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function ajoutOffre(StoreOffreRequest $request)
    {   
        
        $user= auth()->user();
        if (!auth()->user()->role=='entreprise') {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
        $entreprise=$user->entreprise;
        $entreprise_id=$entreprise->id;
        $data= $request->all();
        $validator = Validator::make($data,[
            'titre' => 'required|max:255',
            'type_contrat' => 'required|in:CDI,CDD',
            'rythme' => 'required|in:full time,part time',
            'type_region' => 'required|in:remote,office',
            'diplome' => 'required|in:bac+1,bac+2,bac+3,bac+4,bac+5',
            'experience' => "required|in:aucune experience,moins d'un an,entre 1 et 2 ans,entre 2 et 5 ans,entre 5 et 10 ans,plus que 10 ans",
            'salaire' => 'required|digits_between:3,5',
            'outils' => 'required|max:255',
            'avantages' => 'required|max:1000',
            'conpetences' => 'required|min:4',
            'description' => 'required|max:1000',
            'date' => 'required|date|after:today',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors());
        };
        $offre = Offre::create([
            'entreprise_id'     => $entreprise_id,
            'titre'       => $request->titre,
            'type_contrat'    => $request->type_contrat,
            'type_region'    => $request->type_region,
            'diplome'      => $request->diplome,
            'experience'     => $request->experience,
            'salaire'     => $request->salaire,
            'outils'      => $request->outils,
            'avantages'         => $request->avantages,
            'conpetences'          => $request->conpetences,
            'description'          => $request->description,
            'date'          => $request->date,
            
        ]);
        return response()->json(['offre crée', new OffreResource($offre)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function show($id=null)
    {
        $offre = Offre::find($id);
        if (is_null($offre)) {
            return response()->json([
                "success" => false,
                "message" => "Offre non trouvée",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "Offre trouvée",
        "offre" => $offre
        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
       //
    }
    // Search
    public function search(Request $request)
    {
        $titre = $request->get('titre');
        $region = $request->get('region');
        $categorie = $request->get('categorie_id');
        $experience = $request->get('experience');
        $education = $request->get('education');
        if($titre||$region||$categorie||$experience||$education){
        $offres = Offre::where('titre', 'LIKE','%'.$titre.'%') 
                ->orWhere('education',$education)
                ->orWhere('experience',$experience)
                ->orWhere('region',$region)
                ->orWhere('categorie_id',$categorie)
                ->paginate(25);
        }
        $offres=Offre::lastest()->paginate(25);
        return response()->json([
            "success" => true,
            "message" => "la liste des offres",
            "offres" => $offres
            ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOffreRequest  $request
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOffreRequest $request)
    {   
        $user= auth()->user();
        $offre=Offre::find($request->offre_id)->first();
        if ($offre->entreprise_id != $user->entreprise->id) {
            return response()->json(['error' => 'you have to be employer'], 404);
        }
        $offre->update($request->all());
        return response(['offre' => new OffreResource($offre), 'message' => 'Update successfully'], 200); //
    }
    public function destroyJob(Request $request)
    {
        $user= auth()->user();
        $entreprise_id = $request->user()->entreprise->id;
        $offre= Offre::where('id', $request->offre_id)->where('entreprise_id', $entreprise_id)->first();
        if ($offre->entreprise_id != $user->entreprise->id) {
            return response()->json(['error' => 'you have to be employer'], 404);
        }
        $offre->etat_offre = 'deleted';
        if ($offre->save()) {
            return response()->json(['data' => $offre, 'message' => 'You have deleted offre.']);
        } else {
            return response()->json(['message' => 'Failed to delete offre.'], 500);

        }
    }
    public function closeOffre(Request $request)
    {
        $user= auth()->user();
        $entreprise_id = $request->user()->entreprise->id;
        $offre= Offre::where('id', $request->offre_id)->where('entreprise_id', $entreprise_id)->first();
        if ($offre->entreprise_id != $user->entreprise->id) {
            return response()->json(['error' => 'you have to be employer'], 404);
        }
        $offre->etat_ofre = 'closed';
        if ($offre->save()) {

            return response()->json(['data' => $offre, 'message' => 'You have updated offre.']);
        } else {
            return response()->json(['message' => 'Failed to close offre.'], 500);

        }

    }
    public function activeOffre(Request $request)
    {
        $user= auth()->user();
        $entreprise_id = $request->user()->entreprise->id;
        $offre = Offre::where('id', $request->offre_id)->where('entreprise_id', $entreprise_id)->first();
        if ($offre->entreprise_id != $user->entreprise->id) {
            return response()->json(['error' => 'you have to be employer'], 404);
        }
        $offre->status = 'active';
        if ($offre->save()) {

            return response()->json(['data' => $offre, 'message' => 'You have updated offre.']);
        } else {
            return response()->json(['message' => 'Failed to active offre.'], 500);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function destroy( Offre $offre)
    {   
        $user= auth()->user();
        if ($offre->entreprise_id != $user->entreprise->id) {
            return response()->json(['error' => 'vous devez avoir un compte entreprise'], 404);
        }
        $offre->delete();
        return response()->json(['message' => 'Deleted']);
    }//
}

