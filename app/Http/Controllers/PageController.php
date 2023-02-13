<?php

namespace App\Http\Controllers;

use App\Api\MyApi;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function viewProducts(MyApi $api)
    {
        $products = $api->getCollection('product/all')['body'];
        
        return view('shop.viewProducts', compact('products'));
    }
}
