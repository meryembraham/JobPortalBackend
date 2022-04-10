<?php

namespace App\Http\Controllers;

use App\Models\Demande;
use App\Http\Requests\StoreDemandeRequest;
use App\Http\Requests\UpdateDemandeRequest;
use App\Models\Condidat;
use App\Models\Entreprise;
use App\Models\Offre;
use Carbon\Carbon;
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

        $demandes = Demande::all();

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
        $demande = Demande::where(['condidat_id' => $condidat->id, 'offre_id' => $offre_id])->first();
        if ($demande) {
            return response()->json(['message' => 'You already applied for this job'], 403);
        } elseif (!$demande && $condidat->documents) {
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
        $demande = Demande::find($id);
        $offre = $demande->offre();
        $condidat = $demande->condidat;
        $entreprise = $offre->entreprise();
        return response()->json([
            'success' => true,
            'condidat' => $condidat,
            'offre' => $offre,
            'entreprise' => $entreprise,
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
    public function accept(Request $request)
    {
        $demande = Demande::find($request->id);
        $demande->offre->update([
            'etat_offre' => 'closed',
            'user_accept' => $demande->condidat_id
        ]);

        foreach ($demande->offer->demandes as $d) {
            $d->update(['status' => 'rejected']);
        }
        $demande->update(['status' => 'accepted']);
        return response()->json([
        'success' => true,
            'message' => 'Demande acceptée'
        ]);
    }
    public function reject(Request $request)
    {
        $user=auth()->user();
        $demande = Demande::find($request->id)->first();
        $offre_id = $demande->offre_id;
        $offre = Offre::where('id',$offre_id)->first();
        $entreprise_id = $offre->entreprise_id;
        if ($entreprise_id == $user) {
        
            $demande->status = "rejected"; 
            if ($demande->save()) {
                return response()->json(['message' => 'Demande rejected successfully.'], 200);
            } else {
                return response()->json(['message' => 'error'], 500);
            }
        } else {
            return response()->json(['message' => 'error'], 500);
        }

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
