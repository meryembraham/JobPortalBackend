<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Condidat;
use App\Http\Requests\StoreCondidatRequest;
use App\Http\Requests\UpdateCondidatRequest;
use App\Models\Offre;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\CondidatResource;
use App\Models\Demande;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use League\CommonMark\Inline\Element\Image;
class CondidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condidats = Condidat::with('experiences')->with('formations')->with('user')->with('region')->with('secteur')->get();
        return response()->json(['condidats' => new CondidatResource($condidats), 'message' => 'Retrieved successfully'], 200);
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
     * @param  \App\Http\Requests\StoreCondidatRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCondidatRequest $request)
    {
        $condidat = Condidat::whereId(auth()->id());
        $data = $request->all();
        $validator = Validator::make($data,[
            'nom' => 'required|max:255',
            'prenom' => 'required|string',
            'tel' => 'required|string',
            'avatar' => ['nullable', 'file', 'mimes:jpeg,jpg,png,gif,bmp', 'max:1024'],
            'type' => 'required|string',
            'education' => 'required|in:bac+1,bac+2,bac+3,bac+4,bac+5',
            'experience' => "required|in:aucune experience,moins d'un an,entre 1 et 2 ans,entre 2 et 5 ans,entre 5 et 10 ans,plus que 10 ans",
            'langues' => 'required|string',
            'description' => 'required|string',
            'competences' => 'required|string',
            'localisation' => 'required|string',
            'date' => 'required|date|date_format:Y-m-d|before:'.now()->subYears(18)->toDateString(),
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors());
        }
        return response()->json(['condidate created successfully.', new CondidatResource($condidat)]);
        $image = $request->file('avatar');
        $allowed_extensions = ['jpeg', 'jpg', 'png', 'gif'];

    if ($image) {
      // make the unique name for the image
        $currentDate = Carbon::now()->toDateString();
        $imageName = $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

    if (!Storage::disk('public')->exists('avatar')) {
        Storage::disk('public')->makeDirectory('avatar');
    }

      // delete old avatar image
    if (Storage::disk('public')->exists('avatar/' . $condidat->avatar)) {
        Storage::disk('public')->delete('avatar/' . $condidat->avatar);
    }

        $filepath = $image->storeAs('avatar', $imageName, 'public');
    } else {
        $imageName = $condidat->avatar;
    }
    $condidat->nom = $request->nom;
    $condidat->prenom = $request->prenom;
    $condidat->tel = $request->tel;
    $condidat->competences = $request->competences;
    $condidat->date = $request->date;
    $condidat->localisation = $request->localisation;
    $condidat->langues = $request->langues;
    $condidat->avatar = $imageName;
    $condidat->education = $request->education;
    $condidat->type = $request->type;
    $condidat->description = $request->description;
    $condidat->experience = $request->experience;
    $condidat->save();
    return response()->json([
        "success" => true,
        "message" => "Condidat created successfully"
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Condidat  $condidat
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $condidat = Condidat::where('id',$id)->with('experiences')->with('formations')->with('region')->with('secteur')->with('user')->get();
        if (is_null($condidat)) {
            return response()->json([
                "success" => false,
                "message" => "Condidat non trouvé",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "Condidat retrieved successfully.",
        "condidat" => $condidat
        ]);
        // return response(['condidat' => new CondidatResource($condidat), 'message' => 'Retrieved successfully'], 200);
    }
    public function search(Request $request)
    {
        //$titre = $request->get('mot-cle');
        $experience = $request->get('experience');
        $niveau = $request->get('niveau');
       
        $region = $request->get('region_id');
        $secteur = $request->get('secteur_id');
        
        $condidats =Condidat::select()->with('user')->with('region')->with('secteur')->with('experiences')->where(function($q)  {
            

        })->where(function($q) use($region,$secteur,$experience,$niveau){
            if ($region){
                $q->orWhere('region_id',"{$region}");
            }
            if ($secteur){
                $q->orWhere('secteur_id',"{$secteur}");
            }
            if($experience){
                $q->orWhere('experience',"{$experience}");
            }
            if($niveau){
                $q->orWhere('niveau',"{$niveau}");
            }
           
           
            
            
        })->paginate(5);
        $nbr = $condidats->count();
       // $offres = Offre::lastest()->paginate(25);
        return response()->json([
            "success" => true,
            "message" => "la liste des condidats",
            "condidats" => $condidats,

        ]);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Condidat  $condidat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCondidatRequest  $request
     * @param  \App\Models\Condidat  $condidat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $condidat=Condidat::find($id);
        $condidat->update($request->all());
        return response(['condidat' => new CondidatResource($condidat), 'message' => 'Update successfully'], 200);//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Condidat  $condidat
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $condidat = Condidat::findOrFail($id);
        $condidat->delete();
        return response(['message' => 'Condidat Deleted successfully']);
    }

    public function appliedJobs(Request $request)
    {   $id=auth()->user()->id;
        $condidat_id=Condidat::where('user_id','=',$id)->first()->get();
        $appliedJobs = Demande::where('condidat_id','=', $condidat_id)->get();
        return response()->json(['data' => $appliedJobs]);
    }
}