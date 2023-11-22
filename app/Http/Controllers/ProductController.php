<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Product;
use Illuminate\Http\File;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use App\Models\ProductConfiguration;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $product = Product::all();
        $response = [
            "status" => 200,
            "data" => [
                "all_products" => $product
            ],
        ];
        return response()->json($response);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        // dd($request->all());
        $configs = json_decode($request->config, true);
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
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id)->with('configuration.color', 'configuration.size')->first();
        $groupedConfigurations = $product->configuration;
        $raw_images = ProductImage::where('product_id', '=', $id)->get();
        foreach ($raw_images as $image) {
            $images[] = url('/storage/product_images/' . $image->url);
        }


        $response = [
            "name" => $product->name,
            "config" => $groupedConfigurations,
            "images" => $images,
            // "file" => $file,
        ];


        return response()->json($response);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // $configs = json_decode($request->config, true);
        $configs = $request->config;
        $product = Product::find($id);
        $product->name = $request->name === null || '' ? $product->name : $request->name;
        $product->save();

        foreach ($configs as  $config) {
            if (isset($config['id'])) {
                $existing_config = ProductConfiguration::find($config['id']);
                $existing_config->color_id = $config['color_id'];
                $existing_config->size_id = $config['size_id'];
                $existing_config->quantity = $config['quantity'];
                $existing_config->save();
            } else {
                $new_config = new ProductConfiguration();
                $new_config->color_id = $config['color_id'];
                $new_config->size_id = $config['size_id'];
                $new_config->quantity = $config['quantity'];
                $new_config->product_id = $product->id;
                $new_config->save();
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        $product->delete();
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
