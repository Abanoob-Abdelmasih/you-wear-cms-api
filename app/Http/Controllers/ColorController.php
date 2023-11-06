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
        $all_colors = Color::all();
        if ($all_colors) {
            $response = [
                "body" => [
                    "status" => 200,
                    "all_colors" => $all_colors
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
        $color = Color::find($id);
        if (!empty($color)) {
            $response = [
                "body" => [
                    "status" => 200,
                    "color" => $color
                ],
            ];
            return response()->json($response);
        } else {
            $response = [
                "body" => [
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
        $color = Color::find($id);
        if (!empty($color)) {
            $color->name = $request->name === null || '' ? ucwords($color->name) : ucwords($request->name);
            $color->hexcode =  $request->hexcode === null || '' ? strtoupper($color->hexcode) : strtoupper($request->hexcode);
            $color->isActive = $request->isActive === null || '' ? $color->isActive : $request->isActive;
            $colorDetails = [
                "name" => $color->name,
                "hexcode" => $color->hexcode,
                "isActive" => $color->isActive
            ];
            if ($color->save()) {
                $response = [
                    "body" => [
                        "status" => 200,
                        "message" => "Updated successfully",
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
                return response()->json($response);
            };
        } else {
            $response = [
                "body" => [
                    "status" => 500,
                    "message" => "Color doesn't exist"
                ],
            ];
            return response()->json($response);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
