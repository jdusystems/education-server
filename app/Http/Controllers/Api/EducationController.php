<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\EducationCollection;
use App\Http\Resources\EducationResource;
use App\Models\Education;
use App\Http\Requests\StoreEducationRequest;
use App\Http\Requests\UpdateEducationRequest;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $educations = Education::all();
        return new EducationCollection($educations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEducationRequest $request)
    {
        $education = Education::create([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'website' => $request->website,
            'instagram' => $request->instagram,
            'telegram' => $request->telegram,
            'youtube' => $request->youtube,
            'facebook' => $request->facebook,
            'bio' => $request->bio,
            'certificate' => $request->certificate,
            'logo' => $request->logo,
            'location' => $request->location,
            'address' => $request->address,
            'district_id' => $request->district_id,
            'category_id' => $request->category_id,
            'user_id' => $request->user_id,
        ]);
        return new EducationResource($education);
    }

    /**
     * Display the specified resource.
     */
    public function show(Education $education)
    {
        return new EducationResource($education);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEducationRequest $request, Education $education)
    {
        $education->update([
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'website' => $request->website,
            'district_id' => $request->district_id,
            'instagram' => $request->instagram,
            'telegram' => $request->telegram,
            'youtube' => $request->youtube,
            'facebook' => $request->facebook,
            'bio' => $request->bio,
            'certificate' => $request->certificate,
            'logo' => $request->logo,
            'location' => $request->location,
            'address' => $request->address,
        ]);
        return new EducationResource($education);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Education $education)
    {
        $education->delete();
        return response()->json(["message" => "deleted"], 201);
    }
}
