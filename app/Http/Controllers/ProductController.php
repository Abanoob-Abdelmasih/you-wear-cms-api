<?php

namespace App\Http\Controllers;

use App\Models\ProductConfiguration;
use App\Models\ProductImage;
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
        $product = Product::find(1)->with('configuration.color', 'configuration.size')->get();
        return response()->json($product);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $configs = json_decode($request->config,true);
        $product = new Product();
        $product->name = $request->name;
        $product->save();

        foreach ($configs as  $config) {
            $new_config = new ProductConfiguration();
            $new_config->color_id = $config['color_id'];
            $new_config->size_id = $config['size_id'];
            $new_config->quantity = $config['quantity'];
            $new_config->product_id = $product->id;
            $new_config->save();
        }

        foreach ($request->file('images') as  $image) {
            $new_image = new ProductImage();
            $newImageName = uniqid() . '.' . $image->extension();
            $image->storeAs('public/product_images', $newImageName);
            $new_image->url = $newImageName;
            $new_image->product_id = $product->id;
            $new_image->save();
        }
        // return response()->json($product->with('configuration.color', 'configuration.size', 'productImages')->get());
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
