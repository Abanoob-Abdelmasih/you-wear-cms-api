<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\ProductConfiguration;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $newCartItem = new Cart();
        $newCartItem->user_id = $request->user_id;
        $newCartItem->product_configuration_id = $request->product_configuration_id;
        $newCartItem->quantity = $request->quantity;
        $newCartItem->save();
    }

    public function showCart(string $id)
    {
        $rawCart = Cart::where("user_id", '=', $id)->with('productConfiguration.color', 'productConfiguration.product', 'productConfiguration.size')->get();
        $cart = $rawCart->map(function ($item) {
            return [
                'cart_id' => $item->id,
                'quantity' => $item->quantity,
                'product' => $item->productConfiguration->product,
                'color' => $item->productConfiguration->color,
                'size' => $item->productConfiguration->size,
            ];
        });
        $response = [
            "status" => 200,
            "data" => [
                "cart" => $cart,
            ],
        ];

        return response()->json($response);
    }

    public function removeFromCart(Request $request)
    {
        if (Cart::destroy($request->id)) {
            $response = [
                "status" => 200,
                "data" => [
                    "message" => "Item removed successfully",
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

    public function updateCart(Request $request)
    {
        $productQty = ProductConfiguration::find($request->product_id);
        $cart = Cart::find($request->cart_id);
        if ($request->updateType === 'add' && intval($productQty->quantity) > intval($cart->quantity) + 1) {
            $cart->quantity = $cart->quantity + 1;
            $cart->save();
            $response = [
                "status" => 200,
                "data" => [
                    "message" => "Cart Updated",
                    "cart" => $cart
                ],
            ];
            return response()->json($response);
        } else if($request->updateType === 'add' && intval($productQty->quantity) < intval($cart->quantity) + 1) {
            $response = [
                "status" => 500,
                "data" => [
                    "message" => "Out of Stock"
                ],
            ];
            return response()->json($response);
        }

        if ($request->updateType === "sub") {

            $cart->quantity = $cart->quantity - 1;
            if ($cart->quantity === 0) {
                Cart::destroy($request->cart_id);
                $response = [
                    "status" => 200,
                    "data" => [
                        "message" => "Item removed successfully",
                    ],
                ];
                return response()->json($response);
            } else if ($cart->save()) {
                $response = [
                    "status" => 200,
                    "data" => [
                        "message" => "Cart Updated",
                        "cart" => $cart
                    ],
                ];
                return response()->json($response);
            }
        }
    }
}
