<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DistrictCollection;
use App\Http\Resources\DistrictResource;
use App\Models\District;
use App\Http\Requests\StoreDistrictRequest;
use App\Http\Requests\UpdateDistrictRequest;

class DistrictController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $districts = District::all();
        return new DistrictCollection($districts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDistrictRequest $request)
    {
        $district = District::create([
            "name" => $request->name,
            "region_id" => $request->region_id,
        ]);
        return new DistrictResource($district);
    }

    /**
     * Display the specified resource.
     */
    public function show(District $district)
    {
        return new DistrictResource($district);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDistrictRequest $request, District $district)
    {
        $district->update([
            "name" => $request->name,
            "region_id" => $request->region_id,
        ]);
        return new DistrictResource($district);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(District $district)
    {
        $district->delete();
        return response()->json(["message" => "deleted"], 201);
    }
}
