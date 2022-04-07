<?php

namespace App\Http\Controllers;

use App\Models\Entreprise;
use App\Http\Resources\EntrepriseResource;
use App\Http\Requests\StoreEntrepriseRequest;
use App\Http\Requests\UpdateEntrepriseRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Offre;
class EntrepriseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Entreprise::latest()->get();
        return response()->json([EntrepriseResource::collection($data), 'entreprise fetched.']);//
    }
    public function offres($id, Request $request)
    {   
        $entreprise=Entreprise::where('id',$id)->get();
        $offres = Offre::where('entreprise_id',$id)->get();
        return response()->json([
            "success" => true,
            "message" => "offres retrieved successfully.",
            "entreprise"=> $entreprise,
            "offres" => $offres
            ]);
        
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
     * @param  \App\Http\Requests\StoreEntrepriseRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Entreprise $entreprise)
    {
        $data = $request->all();
        $validator = Validator::make($data,[
            'nom' => 'required|max:255',
            'description' => 'required|max:1000',
            'logo' => 'image',
            'site' => 'required|max:1000',
            'adresse' => 'required|max:1000',
            'tel' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'slogan' => 'required|max:255',
            'cover_img' => 'image',
        ]);
        if ($validator->fails()){
            return response()->json($validator->errors());
        }
        $entreprise->user_id = auth()->user()->id;
        $entreprise->nom = $request->nom;
        $entreprise->description = $request->description;
        $entreprise->slogan = $request->slogan;
        $entreprise->site = $request->site;
        $entreprise->tel = $request->tel;
        $entreprise->adresse = $request->adresse;
        //logo
        $fileNameToStore = $this->getFileName($request->file('logo'));
        $logoPath = $request->file('logo')->storeAs('public/entreprises/logos', $fileNameToStore);
        if ($entreprise->logo) {
            Storage::delete('public/entreprises/logos/' . basename($entreprise->logo));
        }
        $entreprise->logo = 'storage/entreprises/logos/' . $fileNameToStore;

        //cover image 
        if ($request->hasFile('cover_img')) {
            $fileNameToStore = $this->getFileName($request->file('cover_img'));
            $coverPath = $request->file('cover_img')->storeAs('public/entreprises/cover', $fileNameToStore);
            if ($entreprise->cover_img) {
                Storage::delete('public/entreprises/cover/' . basename($entreprise->cover_img));
            }
            $entreprise->cover_img = 'storage/entreprises/cover/' . $fileNameToStore;
        } else {
            $entreprise->cover_img = 'nocover';
        }

        if ($entreprise->save()) {
            return response()->json([
                "success" => true,
                "message" => "Entreprise created successfully.",
                "data" => $entreprise
                ]);
        }
        return response()->json([
            "success" => false,
            "message" => "error",
            ]);
    }
    
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entreprise = Entreprise::find($id);
        if (is_null($entreprise)) {
            return response()->json([
                "success" => false,
                "message" => "Entreprise non trouvée",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "Entreprise retrieved successfully.",
        "data" => $entreprise
        ]);//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function edit(Entreprise $entreprise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEntrepriseRequest  $request
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Entreprise $entreprise)
    {
        $entreprise->user_id = auth()->user()->id;
        $entreprise->nom = $request->nom;
        $entreprise->description = $request->description;
        $entreprise->adresse = $request->adresse;
        $entreprise->site = $request->site;
        $entreprise->tel = $request->tel;
        $entreprise->slogan = $request->slogan;
        //logo should exist but still checking for the name
        if ($request->hasFile('logo')) {
            $fileNameToStore = $this->getFileName($request->file('logo'));
            $logoPath = $request->file('logo')->storeAs('public/entreprises/logos', $fileNameToStore);
            if ($entreprise->logo) {
                Storage::delete('public/entreprises/logos/' . basename($entreprise->logo));
            }
            $entreprise->logo = 'storage/entreprises/logos/' . $fileNameToStore;
        }

        //cover image 
        if ($request->hasFile('cover_img')) {
            $fileNameToStore = $this->getFileName($request->file('cover_img'));
            $coverPath = $request->file('cover_img')->storeAs('public/entreprises/cover', $fileNameToStore);
            if ($entreprise->cover_img) {
                Storage::delete('public/entreprises/cover/' . basename($entreprise->cover_img));
            }
            $entreprise->cover_img = 'storage/entreprises/cover/' . $fileNameToStore;
        }
        $entreprise->cover_img = 'nocover';
        if ($entreprise->save()) {
            return response()->json([
                "success" => true,
                "message" => "Entreprise updated",
                "data" => $entreprise
                ]);
        }
        return response()->json([
            "success" => false,
            "message" => "erreur",
            ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Entreprise  $entreprise
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Storage::delete('public/entreprises/logos/' . basename(auth()->user()->entreprise->logo));
        if (auth()->user()->entreprise->delete()) {
            return response(['message' => 'Deleted']);
        }
        $entreprise = Entreprise::findOrFail($id);
        $entreprise->delete();
        return response()->json([
            "success" => true,
            "message" => "entreprise supprimée",
            ]);//
    }
    protected function getFileName($file)
    {
        $fileName = $file->getClientOriginalName();
        $actualFileName = pathinfo($fileName, PATHINFO_FILENAME);
        $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
        return $actualFileName . time() . '.' . $fileExtension;
    }
}
