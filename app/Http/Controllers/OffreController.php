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
            Log::alert('You must create a company first!', 'info');
            return redirect()->route('entreprise.create');
        }
        return view('offre.create');//
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOffreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOffreRequest $request)
    {   
        $user_id= auth()->user()->id;
        $user= auth()->user();
        if (!auth()->user()->role=='entreprise') {
            Log::alert('vous devez un compte entreprise', 'info');
            return redirect()->route('entreprise.create');
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
        return response()->json(['offre created successfully.', new OffreResource($offre)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $offre = Offre::find($id);
        if (is_null($offre)) {
            return $this->sendError('Offre not found.');
        }
        return response()->json([
        "success" => true,
        "message" => "Offre retrieved successfully.",
        "data" => $offre
        ]);
        // return response(['offre' => new OffreResource($offre), 'message' => 'Retrieved successfully'], 200);
        
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
            "data" => $offres
            ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOffreRequest  $request
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOffreRequest $request, $offre)
    {   
        $user= auth()->user();
        if ($offre->entreprise_id != $user->entreprise->id) {
            return response()->json(['error' => 'vous devez avoir un compte entreprise'], 404);
        }
        $offre->update($request->all());
        return response(['offre' => new OffreResource($offre), 'message' => 'Update successfully'], 200); //
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
        return response(['message' => 'Deleted']);
    }//
}
