<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use App\Http\Resources\FormationResource;
use App\Models\Condidat;
use App\Models\Formation;
use App\Models\User;

class FormationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    }
    public function addEdu(Request $request)
    {
      $user=$request->user()->id;
      $condidat=Condidat::where('user_id',$user)->first();
      $condidat_id=$condidat->id;
    
   
        $data = $request->all();
        $data['condidat_id'] =$condidat_id;
        $edu = Formation::create($data);
        return response()->json(['edu crée', new FormationResource($edu)]);
    }//
    public function formC($id)
{
        $condidat=Condidat::find($id);
        $condidat_id=$condidat->id;
      $expC=Formation::where('condidat_id',$condidat_id)->get();
      return response()->json(['formation'=> new FormationResource($expC)]);
}
public function formU($id)
{
        $user=User::find($id);
        $user_id=$user->id;
        $condidat=Condidat::where('user_id',$user_id)->first();
        $condidat_id=$condidat->id;
      $expU=Formation::where('condidat_id',$condidat_id)->get();
      return response()->json(['formation'=> new FormationResource($expU)]);
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
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
