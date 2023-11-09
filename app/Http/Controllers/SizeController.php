<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Size::all();

        if ($data) {
            $all_Sizes = $data->map(function ($size) {
                $size->isActive = $size->isActive == 1 ? 'Active' : 'Deactivated';
                return $size;
            });
            $response = [
                "status" => 200,
                "data" => [
                    "all_sizes" => $all_Sizes
                ],
            ];
            return response()->json($response);
        } else {
            $response = [
                "status" => 500,
                "data" => [
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
        if ($size->save()) {
            $response = [
                "status" => 200,
                "data" => [
                    "sizeDetails" => $size
                ],
            ];
            return response()->json($response);
        } else {
            $response = [
                "status" => 500,
                "data" => [
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
                "status" => 200,
                "data" => [
                    "size" => $size
                ],
            ];
            return response()->json($response);
        } else {
            $response = [
                "status" => 500,
                "data" => [
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
        $size = Size::find($id);
        if (!empty($size)) {
            $size->name = $request->name === null || '' ? ucwords($size->name) : ucwords($request->name);
            $size->abbreviation =  $request->abbreviation === null || '' ? strtoupper($size->abbreviation) : strtoupper($request->abbreviation);
            $size->isActive = $request->isActive === null || '' ? $size->isActive : $request->isActive;
            $sizeDetails = [
                "name" => $size->name,
                "abbreviation" => $size->abbreviation,
                "isActive" => $size->isActive
            ];
            if ($size->save()) {
                $response = [
                    "status" => 200,
                    "data" => [
                        "message" => "Updated successfully",
                        "sizeDetails" => $sizeDetails
                    ],
                ];
                return response()->json($response);
            } else {
                $response = [
                    "status" => 500,
                    "data" => [
                        "message" => "Something went wrong"
                    ],
                ];
                return response()->json($response);
            };
        } else {
            $response = [
                "status" => 500,
                "data" => [
                    "message" => "Size doesn't exist"
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
        $size = Size::find($id);

        if (!empty($size)) {
            if ($size->delete()) {
                $all_Sizes = Size::all()->map(function ($size) {
                    $size->isActive = $size->isActive == 1 ? 'Active' : 'Deactivated';
                    return $size;
                });
                $response = [
                    "status" => 200,
                    "data" => [
                        "message" => "Deleted successfully",
                        "sizes" => $all_Sizes
                    ],
                ];
                return response()->json($response);
            } else {
                $response = [
                    "status" => 500,
                    "data" => [
                        "message" => "Something went wrong"
                    ],
                ];
                return response()->json($response);
            }
        } else {
            $response = [
                "status" => 500,
                "data" => [
                    "message" => "Size doesn't exist"
                ],
            ];
            return response()->json($response);
        }
    }

    public function convertActive()
    {
    }


    public function many2ManyExamples(Request $request)
    {
        // $color = Color::find(2);
        // $color->sizes()->sync([1, 2]);
        // dd($color);

        // $configOptionData = [
        //     //  #where 1 and 2 are size ID's
        //     1 => [
        //         "quantity" => 2
        //     ],
        //     2 => [
        //         "quantity" => 4
        //     ]
        // ];
        // $color = Color::find(2);
        // $color->sizes()->sync($configOptionData);


        // $sizes = Color::find(2)->sizes;
        // return $sizes;

        // $sizes = Color::find(2)->load("sizes");
        // return $sizes;
    }
}
