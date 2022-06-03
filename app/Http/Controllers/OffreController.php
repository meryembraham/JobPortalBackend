<?php

namespace App\Http\Controllers;

use App\Models\Offre;
use App\Http\Requests\StoreOffreRequest;
use App\Http\Requests\UpdateOffreRequest;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\OffreResource;
use App\Models\Entreprise;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use SebastianBergmann\Environment\Console;
use App\Models\Demande;
class OffreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $offres = Offre::where('etat_offre','active')->with('region')->with('secteur')->get();
        return response()->json(['offres' => new OffreResource($offres), 'message' => 'Retrieved successfully'], 200);
    }
    public function last()
    {
        $offres = Offre::lastest();
        return response()->json(['offres' => new OffreResource($offres), 'message' => 'Retrieved successfully'], 200);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }
public function Offredemandes($id)
{
    $demandes=Demande::where('offre_id',$id)->with('condidat')->with('condidat.user')->get();
    return response()->json([
        "success" => true,
       
        "demandes" => $demandes
    ]);
}
    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOffreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function ajoutOffre(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'titre' => 'required|max:255',
            'type_contrat' => 'required',
            'rythme' => 'required',
            'diplome' => 'required',
            'experience' => "required",
            'description' => 'required',
            'date_debut' => 'required',
            'competences'=>'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors());
        };
        $use=$request->entreprise_id;
        $entreprise=Entreprise::where('user_id',$use)->first();
        $entreprise_id=$entreprise->id;
        $data['entreprise_id']= $entreprise_id;
        $offre = Offre::create($data);
        return response()->json(['offre crée', new OffreResource($offre)]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
   public function show($id)
    {
        $offre = Offre::where('id',$id)->with('region')->with('secteur')->with('entreprise')->with('entreprise.user')->with('entreprise.region')->get()->first();
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
    public function edit($id)
    {
        //
    }
    // Search
    public function search1(Request$request)
    {
        $offres=Offre::where('secteur_id',$request->secteur)->get();
        return response()->json([
            'offres'=>$offres
        ]);
    }
    public function search(Request $request)
    {
        //$titre = $request->get('mot-cle');
        $experience = $request->get('experience');
        $rythme = $request->get('rythme');
        $type_contrat=$request->get('type_contrat');
        $region = $request->get('region_id');
        $secteur = $request->get('secteur_id');
        $motcle=explode(" ",$request->get('mot-cle'));
        
       /* if ($titre || $region || $secteur ) {
            $offres = Offre::where('titre', 'LIKE', '%' . $titre . '%')
                ->orWhere('region', $region)
                ->orWhere('secteur_id', $secteur)
                ->paginate(25);
        }*/
        $offres = Offre::select()->with('region')->with('secteur')->where(function($q) use($motcle) {
            foreach($motcle as $mot){
                $q->orWhere('titre', 'LIKE', '%'.$mot.'%');
            }

        })->where(function($q) use($region,$secteur,$experience,$rythme,$type_contrat){
            if ($region){
                $q->orWhere('region_id',"{$region}");
            }
            if ($secteur){
                $q->orWhere('secteur_id',"{$secteur}");
            }
            if($experience){
                $q->orWhere('experience',"{$experience}");
            }
            if($rythme){
                $q->orWhere('rythme',"{$rythme}");
            }
            if($type_contrat){
                $q->orWhere('type_contrat',"{$type_contrat}");
            }
           
            
            
        })->paginate(5);
        $nbr = $offres->count();
       // $offres = Offre::lastest()->paginate(25);
        return response()->json([
            "success" => true,
            "message" => "la liste des offres",
            "offres" => $offres,

        ]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOffreRequest  $request
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function updateoffre(Request $request, $id)
    {
        //$user_id = Auth::id();
        $offre = Offre::find($id);
       // $entreprise = Entreprise::where('user_id', $user_id);
        /*if ($offre->entreprise_id != $entreprise->id) {
            return response()->json(['error' => 'you have to be employer'], 404);
        }*/
       
        $offre->update($request->all());
        return response(['offre' => new OffreResource($offre), 'message' => 'Update successfully'], 200); //
    }
    public function destroyJob(Request $request)
    {
        $user = auth()->user();
        $entreprise_id = $request->user()->entreprise->id;
        $offre = Offre::where('id', $request->offre_id)->where('entreprise_id', $entreprise_id)->first();
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
    public function closeOffre(Request $request, $id)
    {
        /*$user = auth()->user();
        $entreprise_id = $request->user()->entreprise->id;
        $offre = Offre::where('id', $request->offre_id)->where('entreprise_id', $entreprise_id)->first();
        if ($offre->entreprise_id != $user->entreprise->id) {
            return response()->json(['error' => 'you have to be employer'], 404);
        }
        $offre->etat_ofre = 'closed';
        if ($offre->save()) {

            return response()->json(['data' => $offre, 'message' => 'You have updated offre.']);
        } else {
            return response()->json(['message' => 'Failed to close offre.'], 500);
        }*/
        $offre=Offre::find($id);
  /*   $offre([
        'etat_offre'=>'close'
    ]);
     dd($offre); */
          $offre->etat_offre='close';
           $offre->save();
     //       $offre->updated();
    
        return response()->json([
            'success' => true,
                'message' => 'offer closed',
                
                
            ]);
    }
    public function activeOffre($id)
    {
        
        $offre = Offre::find($id);
       
        $offre->etat_offre = 'active';
        $offre->save();
        return response()->json([
            'success' => true,
                'message' => 'offer activated',
                
                
            ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Offre  $offre
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       // $user = auth()->user();
        $offre = Offre::find($id);
      /*  if ($offre->entreprise_id != $user->entreprise->id) {
            return response()->json(['error' => 'vous devez avoir un compte entreprise'], 404);
        }*/
        $offre->delete();
        return response()->json(['message' => 'Deleted']);
    } //
}
