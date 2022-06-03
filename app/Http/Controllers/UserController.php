<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\Condidat;
use App\Models\Entreprise;
use App\Models\Offre;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $users =User::all();
        return response(['users' => new UserResource($users), 'message' => 'Retrieved successfully'], 200);
    }
    public function candidat($id)
    {
        $condidat= Condidat::where('user_id',$id)->with('experiences')->with('formations')->with('region')->with('secteur')->get();
        return response(['candidat' => new UserResource($condidat), 'message' => 'Retrieved successfully'], 200);
        
    }
    public function entreprise($id)
    {
        $entreprise= Entreprise::where('user_id',$id)->with('offres')->with('region')->with('secteur')->get();
        return response(['entreprise' => new UserResource($entreprise), 'message' => 'Retrieved successfully'], 200);
        
    }
    public function users()
    {
        $users = User::latest()->limit(5)->get();
 
        
        return response([ 'users' => new UserResource($users), 'message' => 'categorie Retrieved successfully'], 200);//
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   $user=User::find($id);
        return response(['user' => new UserResource($user), 'message' => 'user Retrieved successfully'], 200);//
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
    public function block(Request $request, $id)
    {
       $user=User::find($id);
        
        if($user)
        {
            $user->status='blocked';
            $user->save();
        }
    
        return response()->json([
            'success' => true,
                'message' => 'user blocked',
                
                
            ]);
//
    }
    public function unblock(Request $request, $id)
    {
        $user=User::find($id);
        
        if($user)
        {
            $user->status='active';
            $user->save();
        }
    
        return response()->json([
            'success' => true,
                'message' => 'user unblocked',
                
                
            ]);
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
        $user = User::Find($id);
        $user->delete();//
        return response()->json([
            "success" => true,
            "message" => "User deleted successfully."
            ]);//
    }
}
