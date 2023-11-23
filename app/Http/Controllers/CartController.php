<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $newCartItem = new Cart();
        $newCartItem->user_id = $request->user_id;
        $newCartItem->product_configuration_id = $request->product_configuration_id;
        $newCartItem->qunatity = $request->qunatity;
        $newCartItem->save();
    }

    public function showCart(string $id)
    {
        $rawCart = Cart::where("user_id", '=', $id)->with('productConfiguration.color', 'productConfiguration.product', 'productConfiguration.size')->get();
        $cart = $rawCart->map(function ($item) {
            return [
                'cart_id' => $item->id,
                'qunatity' => $item->qunatity,
                'product' => $item->productConfiguration->product,
                'color' => $item->productConfiguration->color,
                'size' => $item->productConfiguration->size,
            ];
        });
        $response = [
            "status" => 200,
            "data" => [
                "cart" =>$cart,
            ],
        ];

        return response()->json($response);
    }

    public function removeFromCart(Request $request)
    {
        if(Cart::destroy($request->id)){
            $response = [
                "status" => 200,
                "data" => [
                    "message" => "Deleted successfully",
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
    }
}
