<?php

namespace App\Http\Controllers;

use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all_Sizes = Size::all();
        if ($all_Sizes) {
            $response = [
                "data" => [
                    "status" => 200,
                    "all_sizes" => $all_Sizes
                ],
            ];
            return response()->json($response);
        } else {
            $response = [
                "data" => [
                    "status" => 500,
                    "message" => "Something went wrong"
                ],
            ];
        };
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $size = new Size();
        $size->name = ucwords($request->name);
        $size->abbreviation =  strtoupper($request->abbreviation);
        $size->isActive = $request->isActive;
        $sizeDetails = [
            "name" => $size->name,
            "abbreviation" => $size->abbreviation,
            "isActive" => $size->isActive
        ];
        if ($size->save()) {
            $response = [
                "data" => [
                    "status" => 200,
                    "sizeDetails" => $sizeDetails
                ],
            ];
            return response()->json($response);
        } else {
            $response = [
                "data" => [
                    "status" => 500,
                    "message" => "Something went wrong"
                ],
            ];
        };
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $size = Size::find($id);
        if (!empty($size)) {
            $response = [
                "data" => [
                    "status" => 200,
                    "size" => $size
                ],
            ];
            return response()->json($response);
        } else {
            $response = [
                "data" => [
                    "status" => 500,
                    "message" => "Doesn't exist"
                ],
            ];
            return response()->json($response);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
