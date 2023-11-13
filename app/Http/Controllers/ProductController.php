<?php

namespace App\Http\Controllers;

use App\Models\ProductConfiguration;
use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::find(1)->with('productconfigurations.color','productconfigurations.size')->get();
        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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

    public function imgTemp(Request $request)
    {

        dd($request->file('images'));
        $imageNames = [];
        foreach ($request->file('images') as $key => $image) {
            $newImageName = time() . '-' . $request->name[$key] . '.' . $image->extension();
            $image->move(public_path('images'), $newImageName);
            $imageNames[] = $newImageName;
        }
    }

    public function addProduct(Request $request)
    {
        foreach ($request->file('images') as  $image) {
            $newImageName = uniqid() . '.' . $image->extension();
            $image->storeAs('public/product_images', $newImageName);
            $imageNames[] = $newImageName;
        }
        $imageUrl = public_path() . '/product_images';
        return response()->json($imageUrl);
    }
}
