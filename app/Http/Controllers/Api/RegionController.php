<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictCollection;
use App\Http\Resources\RegionCollection;
use App\Http\Resources\RegionResource;
use App\Models\Region;
use App\Http\Requests\StoreRegionRequest;
use App\Http\Requests\UpdateRegionRequest;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regions = Region::all();
        return new RegionCollection($regions);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRegionRequest $request)
    {
        $region = Region::create([
            "name" => $request->name,
        ]);
        return new RegionResource($region);
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        return new RegionResource($region);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRegionRequest $request, Region $region)
    {
        $region->update([
            "name" => $request->name,
        ]);
        return new RegionResource($region);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $region->delete();
        return response()->json(["message" => "deleted"], 201);
    }

    public function withDistricts()
    {
        $regions = Region::all()->load("districts");
        return new RegionCollection($regions);
    }

    public function districts(Region $region)
    {
        return new DistrictCollection($region->districts);
    }
}
