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
}
