<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Http\Requests\StoreDemandeRequest;
use App\Http\Requests\UpdateDemandeRequest;
use App\Models\Condidat;
use App\Models\Document;
use App\Models\Entreprise;
use App\Models\Offre;
use Carbon\Carbon;
use App\Http\Resources\DemandeResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class DemandeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $demandes = Demande::with('offre')->with('condidat')->get();

        return response()->json([
            'demandes' => $demandes
        ]);
    }
    public function demandeEntreprise()
    {
        $entreprise = auth()->user()->entreprise;
        if ($entreprise) {
            $ids =  $entreprise->offres()->pluck('id');
            $demandes = Demande::whereIn('offre_id', $ids);
            return response()->json([
                'demandes' => $demandes
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'error'
            ]);
        }
    }
    public function demandeOffre(Request $request)
    {
      $demandes=Demande::where('offre_id',$request->offre_id)->get();
      return response()->json($demandes);
    }
    public function demandeCondidat(Request $request)
    {
        $user_id = $request->user()->id;
        $condidat=Condidat::where('user_id' ,'=', $user_id)->get();
        $demandes= Demande::whereIn('condidat_id', $condidat)->with('offre')->with('offre.entreprise')->get();
         return response()->json($demandes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($offre_id)
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDemandeRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function ajoutDemande($offre_id, Request $request)
    {
        $user_id = $request->user()->id;
        $condidat = Condidat::where(['user_id' => $user_id])->first();
        $condidat_id=$condidat->id;
        $demande = Demande::where(['condidat_id' => $condidat_id, 'offre_id' => $offre_id])->first();
        if ($demande) {
            return response()->json(['message' => 'You already applied for this job'], 403);
          /*if (!$demande && $condidat->documents) {
            $demande = new Demande();
            $demande->offre_id = $offre_id;
            $demande->condidat_id = $condidat->id;
            $demande->status = 'pending';
            $demande->save();
            return response()->json([
                'success' => true,
                'message' => 'Demande ajoutée'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'error'
            ]);
        }*/
    }else {
    
       
        
      
     
          $data = $request->all();
          $data['condidat_id'] =$condidat_id;
          $data['status'] = "pending";
          $data['offre_id'] = $offre_id;
     
        $demande =Demande::create($data);
        return response()->json(['demande ajoutée ', new DemandeResource($demande)]);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $demande = Demande::where('id',$id)->with('offre')->get();
        //$offre = $demande->offre();
       // $condidat_id = $demande->condidat_id;
        //$entreprise = $offre->entreprise();
        return response()->json([
            'success' => true,
           //'condidat' => $condidat_id,
            //'offre' => $offre,
           //'entreprise' => $entreprise,
            'demande' => $demande
        ]); //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function edit(Demande $demande)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDemandeRequest  $request
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDemandeRequest $request, Demande $demande)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Demande  $demande
     * @return \Illuminate\Http\Response
     */
    public function destroy(Demande $demande)
    {
        //
    }
    /**
     * Update the specified resource in storage.
     */
    public function accept($id)
    {
        $demande = Demande::find($id);
        $offre_id=$demande->offre_id;
       $offre=Offre::where('id',$offre_id)->first();
          
            $offre->condidat_id = $demande->condidat_id;
$offre->save();
        /*foreach ($demande->offre->demandes as $d) {
            $d->update(['status' => 'rejected']);
        }*/
        $demande->status ='acceptée';
        $demande->save();
        return response()->json([
        'success' => true,
            'message' => 'Demande accepted'
        ]);
    }
    public function reject($id)
    {
        
        $demande = Demande::find($id);
        
        $demande->status ='refusée';
        $demande->save();
          
        return response()->json(['message' => 'Demande rejected successfully.'], 200);
           

    }
    public function afficherCondidats($offre_id)
    {
        $condidats = Demande::where('offre_id', '=', $offre_id)->get();
        $ids=[];
        foreach($condidats as $c){
            $ids[]=$c->condidat_id;
        }
        $condidats=Condidat::whereIn('id',$ids)->get();
        return response()->json([
            'success' => true,
            'message' => 'les condidats qui ont postuler pour cette offre',
            'condidats' => $condidats,

        ]);
    }
}
