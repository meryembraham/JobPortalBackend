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
        } elseif (!$demande) {
            $demande = new Demande();
            $demande->offre_id = $offre_id;
            $demande->condidat_id = $condidat->id;
            $demande->status = 'suspendu';
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
        $id=$request->id;
        $demande= Demande::where(['id' => $id]);
        $offre=$demande->offre;
        $offre_id=$offre->id;
        $condidat_id=$demande->condidat_id;
        if(Demande::where(['condidat'=>$condidat_id,'offre_id'=>$offre_id])->exists() && $offre->user_id == auth()->user())
        {
            DB::table('offres')->where('offre_id', $offre_id)->update([
            'etat_offre' => 'masquée',
            'condi_accept' => $condidat_id
            ]);
            $demande->status='acceptée';
            $id_accept=$demande->id;
            if (Demande::where(['offre_id'=>$offre_id])->exists())
            {
                DB::table('demandes')
                ->where('offre_id', $offre_id)
                ->where('id','!=',$id_accept)
                ->update([
                    'status'=>'rejetée'
                    ]);

            }
            return response()->json([
                'success' => true,
                'message' => 'Demande acceptée'
            ]);

        }
        //iheb
        // $demande = Demande::find($request->id);

        // $demande->offre->update([
        //     'etat_offre' => 'masquée',
        //     'condi_accept' => $demande->condidat_id
        // ]);

        // foreach ($demande->offer->demandes as $d) {
        //     $d->update(['statue' => 'reff']);
        // }
        // $demande->update(['statue' => 'acc']);
        // return response()->json([
        //     'success' => true,
        //     'message' => 'Demande acceptée'
        // ]);
    }
    public function afficherCondidats($offre_id)
    {
        $condidats = Demande::where('offre_id', '=', $offre_id)->get();
        //iheb
        // $ids=[];
        // foreach($condidats as $c){
        //     $ids[]=$c->condidat_id;
        // }
        // $condidats=Condidat::whereIn('id',$ids)->get();
        return response()->json([
            'success' => true,
            'message' => 'les condidats qui ont postuler pour cette offre',
            'condidats' => $condidats,

        ]);
    }
}
