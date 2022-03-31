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
        //
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
    public function store(Request $request)
    {
        /*$this->validate($request, [
            'cv' => ['nullable', 'file', 'mimes:jpeg,pdf,docx,doc,jpg', 'max:1024'],
        ]);
        $id = Auth()->user()->id;
        $document = Document::where('user_id', $id)-> first();
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

    return response()->json(['success' => true, 'message' => 'document updated']);*/

//
    }
    public function coverletter(Request $request){
        $this->validate($request,[
            'cover_letter'=>'required|mimes:pdf,doc,docx|max:20000'
        ]);
        $user_id = auth()->user()->id;
        $cover = $request->file('cover_letter')->store('public/files');
            Document::where('user_id',$user_id)->update([
                'cover_letter'=>$cover
            ]);
            return response()->json(['success' => true, 'message' => 'cover letter updated']);
        }
    public function resume(Request $request){
            $this->validate($request,[
                'resume'=>'required|mimes:pdf,doc,docx|max:20000'
            ]);
        $user_id = auth()->user()->id;
        $resume = $request->file('cv')->store('public/files');
                Document::where('user_id',$user_id)->update([
                'cv'=>$resume
                ]);
                return response()->json(['success' => true, 'message' => 'resume updated']);
        }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Document  $document
     * @return \Illuminate\Http\Response
     */
    public function show(Document $document)
    {
        //
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
