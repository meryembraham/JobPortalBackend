<?php

namespace App\Http\Controllers;
use App\Http\Resources\ExperienceResource;
use Illuminate\Http\Request;
use App\Models\Experience;
use App\Models\Condidat;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experiences = Experience::all();
        return response(['experince' => new ExperienceResource($experiences), 'message' => 'Retrieved successfully'], 200);//
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->all();
        
        $experience = Experience::create($data);
        return response()->json(['experience crée', new ExperienceResource($experience)]);//
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
    public function addExp(Request $request)
    {
        $user=$request->user()->id;
        $condidat=Condidat::where('user_id',$user)->first();
        $condidat_id=$condidat->id;
      
     
          $data = $request->all();
          $data['condidat_id'] =$condidat_id;
     
        $exp = Experience::create($data);
        return response()->json(['expérience ajoutée ', new ExperienceResource($exp)]);
    }//
public function expC($id)
{
    $condidat=Condidat::find($id);
    $condidat_id=$condidat->id;
      $expC=Experience::where('condidat_id',$condidat_id)->get();
      return response()->json(['experience'=> new ExperienceResource($expC)]);
}
public function expU($id)
{
    $user=User::find($id);
    $user_id=$user->id;
    $condidat=Condidat::where('user_id',$user_id)->first();
    $condidat_id=$condidat->id;
      $expU=Experience::where('condidat_id',$condidat_id)->get();
      return response()->json(['experience'=> new ExperienceResource($expU)]);
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
        $experience = Experience::find($id);
        $experience->update($request->all());
        return response(['experience' => new ExperienceResource($experience), 'message' => 'Update successfully'], 200);//
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
