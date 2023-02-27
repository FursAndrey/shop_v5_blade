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

    public function viewSkus(MyApi $api, int $page = null)
    {
        $skus = $api->getCollection('skus', $page)['body'];

        return view('shop.viewSkus', compact('skus'));
    }

    public function skuPage(int $skuId, MyApi $api)
    {
        $sku = $api->getItem('skus', $skuId)['body'];
        
        return view('shop.skuPage', compact('sku'));
    }

    public function productPage(int $productId, MyApi $api)
    {
        $product = $api->getItem('products', $productId)['body'];
        
        return view('shop.productPage', compact('product'));
    }
}
