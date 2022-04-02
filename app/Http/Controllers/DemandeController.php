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
        
        $entreprise = auth()->user()->entreprise;

        if ($entreprise) {
            $ids =  $entreprise->offres()->pluck('id');
            $demandes = Demande::whereIn('offre_id', $ids);
            
        }

        response()->json([
            'demandes' => $demandes
        ]);
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
    public function ajoutDemande($offre_id, User $user)
    {
        $demande= Demande::where(['user_id' => $user->id, 'offre_id' => $offre_id]);

        if ($demande) {
            return response()->json(['message' => 'You already applied for this job'], 403);
        }
        $demande = new Demande();
        $entreprise = Offre::Find($offre_id);
        $demande->offre_id = $offre_id;
        $demande->entreprise_id = $entreprise->entreprise_id;
        $demande->user_id = Auth::user()->id;
        $demande->status='suspendu';
        $demande->save();
        return response()->json(['success' => true, 'message' => 'Application saved']);
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
        $condidat =$demande->condidat;
        $entreprise = $offre->entreprise();
        response()->json([
            'condidat' => $condidat,
            'offre' => $offre,
            'entreprise' => $entreprise,
            'demande' => $demande
        ]);//
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
        

        }
    }
    

}
