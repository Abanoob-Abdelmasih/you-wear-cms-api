<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

$error_exist = "Something went wrong";
$doesnt_exist = "Color doesn't exist";

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return "test";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $color = new Color();
        $color->name = ucwords($request->name);
        $color->hexcode =  strtoupper($request->hexcode);
        $color->isActive = $request->isActive;
        if ($color->save()) {
            $response = [
                "body" => [
                    "status" => 200,
                    "colorDetails" => $color
                ],
            ];
            return response()->json($response);
        } else {
            $response = [
                "body" => [
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
