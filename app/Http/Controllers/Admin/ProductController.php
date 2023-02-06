<?php

namespace App\Http\Controllers\Admin;

use App\Api\MyApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $page = null, MyApi $api)
    {
        $response = $api->getCollection('products', $page);

        $products = $response['body'];
        
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MyApi $api)
    {
        $categories = $api->getCollection('category/all')['body'];
        $properties = $api->getCollection('property/all')['body'];
        
        return view('product.form', compact('properties', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, MyApi $api)
    {
        $response = $api->sendPost('products', $request->validated());

        if ($response['status'] == 201) {
            return redirect()->route('product.index')->with('success', 'flushes.product_added '.$response['body']->name);
        } else {
            return redirect()->route('product.index')->with('danger', 'Error. Status '.$response['status']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, MyApi $api)
    {
        $response = $api->getItem('products', $id);
        $product = $response['body'];
        
        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, MyApi $api)
    {
        $categories = $api->getCollection('category/all')['body'];
        $properties = $api->getCollection('property/all')['body'];

        $response = $api->getItem('products', $id);
        $product = $response['body'];
        
        return view('product.form', compact('product', 'properties', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, int $id, MyApi $api)
    {
        $response = $api->sendPut('products', $id, $request->validated());
        
        if ($response['status'] == 200) {
            return redirect()->route('product.index')->with('success', 'flushes.product_updated '.$id);
        } else {
            return redirect()->route('product.index')->with('danger', 'Error. Status '.$response['status']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, MyApi $api)
    {
        $response = $api->sendDelete('products', $id);

        if ($response['status'] == 409) {
            return redirect()->route('product.index')->with('danger', $response['body']);
        }
        return redirect()->route('product.index')->with('danger', 'flushes.product_deleted '.$id);
    }
}
