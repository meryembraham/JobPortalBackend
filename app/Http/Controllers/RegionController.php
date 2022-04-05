<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $regions = Region::all();
        return response()->json([
            "success" => true,
            "regions" => $regions,
            ]);//
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
     * @param  \App\Http\Requests\StoreRegionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRegionRequest $request)
    {
        Region::create($request->all());
        return response()->json([
            "success" => true,
            "message" => 'region created successfully',
            ]);//
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function show($region_id)
    {
        $region = Region::find($region_id);
        if (is_null($region)) {
            return response()->json([
                "success" => false,
                "message" => "region non trouvée",
                ]);
        }
        return response()->json([
        "success" => true,
        "message" => "region trouvée",
        "offre" => $region
        ]);//
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Region $region)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRegionRequest  $request
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        $region->update($request->all());
        return response([
            'message' => 'region Update successfully',
            'region' =>$region,
        ], 200);//
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Region  $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json([
            'message' => 'region Deleted']);
    }
}
