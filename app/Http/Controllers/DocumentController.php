<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Http\Requests\StoreDocumentRequest;
use App\Http\Requests\UpdateDocumentRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $documents = Document::all();
        return response([ 'documents' => $documents, 'message' => 'Retrieved successfully'], 200);//
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
     * @param  \App\Http\Requests\StoreDocumentRequest  $request
     * @return \Illuminate\Http\Response
     */
    /*
    **Ajout Cover letter
    */
    public function ajoutCoverletter(Request $request)
    {
        $this->validate($request, [
            'cover' => ['nullable', 'file', 'mimes:jpeg,pdf,docx,doc,jpg', 'max:1024'],
        ]);
        $id = Auth()->user()->condidat->id;
        $document = Document::where('condidat_id', $id)-> first();
        $cover = $request->file('cover_letter');
    $allowed_extensions = ['doc', 'docx', 'pdf', 'jpg', 'jpeg'];
    if ($cover) {
      // make the unique name for the image
    $currentDate = Carbon::now()->toDateString();
    $coverName = $currentDate . '-' . uniqid() . '.' . $cover->getClientOriginalExtension();

    if (!Storage::disk('public')->exists('cover')) {
        Storage::disk('public')->makeDirectory('cover');
    }

      // delete the old cover letter
    if (Storage::disk('public')->exists('cover/' . $document->cover_letter)) {
        Storage::disk('public')->delete('cover/' . $document->cover_letter);
    }

    $filepath = $cover->storeAs('cover', $coverName, 'public');
    } else {
    $coverName = $document->cover_letter;
    }
    $document->cover_letter = $coverName;
    $document->save();

    return response()->json(['success' => true, 'message' => 'Cover letter ajouté']);

    }
    /*
    **Ajout Cv
    */
    public function ajoutCv(Request $request)
    {
        $this->validate($request, [
            'cv' => ['nullable', 'file', 'mimes:jpeg,pdf,docx,doc,jpg', 'max:1024'],
        ]);
        $id = Auth()->user()->condidat->id;
        $document = Document::where('condidat_id', $id)-> first();
        $cv = $request->file('cv');
    $allowed_extensions = ['doc', 'docx', 'pdf', 'jpg', 'jpeg'];
    if ($cv) {
      // make the unique name for the image
    $currentDate = Carbon::now()->toDateString();
    $cvName = $currentDate . '-' . uniqid() . '.' . $cv->getClientOriginalExtension();

    if (!Storage::disk('public')->exists('cv')) {
        Storage::disk('public')->makeDirectory('cv');
    }

      // delete the old cv image
      // delete old cv image
    if (Storage::disk('public')->exists('cv/' . $document->cv)) {
        Storage::disk('public')->delete('cv/' . $document->cv);
    }

    $filepath = $cv->storeAs('cv', $cvName, 'public');
      // Storage::disk('public')->put('cv/' . $cvName, $cv);
    } else {
    $cvName = $document->cv;
    }
    $document->cv = $cvName;
    $document->save();

    return response()->json(['success' => true, 'message' => 'Cv ajouté']);

//
    }
    /*
    **  Update Cover letter
    */
    public function UpdateCoverletter(Request $request){
        $this->validate($request,[
            'cover_letter'=>'required|mimes:pdf,doc,docx|max:20000'
        ]);
        $condidat_id = auth()->user()->condidat->id;
        $cover = $request->file('cover_letter')->store('public/files');
            Document::where('condidat_id',$condidat_id)->update([
                'cover_letter'=>$cover
            ]);
            return response()->json(['success' => true, 'message' => 'cover letter updated']);
        }
    /*
    **  Update Cv
    */
    public function UpdateCv(Request $request){
            $this->validate($request,[
                'cv'=>'required|mimes:pdf,doc,docx|max:20000'
            ]);
        $condidat_id = auth()->user()->condidat->id;
        $cv = $request->file('cv')->store('public/files');
                Document::where('condidat_id',$condidat_id)->update([
                'cv'=>$cv
                ]);
                return response()->json(['success' => true, 'message' => 'CV updated']);
        }
    /*
    **  show Cv
    */
    public function showCv($condidat_id){
        
        $document=Document::where(['condidat_id'=>$condidat_id])->get();
        if (is_null($document)) {
            return response()->json([
                "success" => false,
                "message" => "Document non trouvée",
                ]);
        }elseif(is_null($document->cv)){
            return response()->json([
                "success" => false,
                "message" => "cv non trouvée",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "Cv trouvée",
        "cv" => $document->cv,
        ]);
    }
    /*
    **  show Cover letter
    */
    public function showCover($condidat_id){
        
        $document=Document::where(['condidat_id'=>$condidat_id])->get();
        if (is_null($document)) {
            return response()->json([
                "success" => false,
                "message" => "Document non trouvée",
                ]);
        }elseif(is_null($document->cover_letter)){
            return response()->json([
                "success" => false,
                "message" => "cover letter non trouvée",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "Cover letter  trouvée",
        "cv" => $document->cover_letter,
        ]);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = Document::find($id);
        if (is_null($document)) {
            return response()->json([
                "success" => false,
                "message" => "Document non trouvée",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "Document trouvée",
        "document" => $document
        ]);//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function edit(Document $document)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDocumentRequest  $request
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDocumentRequest $request, Document $document)
    {
        $document->update($request->all());

        return response(['message' => 'Update successfully'], 200);////
    }
    public function showByOwner($condidat_id)
    {
        $document=Document::where(['condidat_id'=>$condidat_id])->get();
        if (is_null($document)) {
            return response()->json([
                "success" => false,
                "message" => "Document non trouvée",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "Document trouvée",
        "documents" => $document
        ]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function destroy(Document $document)
    {
        //
    }
    
        
}
