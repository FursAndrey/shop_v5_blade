<?php

namespace App\Http\Controllers\Admin;

use App\Api\MyApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\SkuCreateRequest;
use App\Http\Requests\SkuUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MyApi $api, int $page = null)
    {
        $response = $api->getCollection('skus', $page);

        $skus = $response['body'];

        return view('sku.index', compact('skus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MyApi $api)
    {
        $products = $api->getCollection('product/all')['body'];
        return view('sku.form', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SkuCreateRequest $request, MyApi $api)
    {
        $response = $api->sendPost('skus', $request->validated());

        if ($response['status'] == 201) {
            return redirect()->route('sku.index')->with('success', 'flushes.sku_added '.$response['body']->name);
        } else {
            return redirect()->route('sku.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->getItem('skus', $id);
        $sku = $response['body'];
        
        return view('sku.show', compact('sku'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, MyApi $api)
    {
        $products = $api->getCollection('product/all')['body'];

        $response = $api->getItem('skus', $id);
        $sku = $response['body'];

        $props = [];
        foreach ($sku->product->properties AS $property) {
            $props[] = $api->getItem('properties', $property->id)['body'];
        }

        return view('sku.form', compact('sku', 'products', 'props'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SkuUpdateRequest $request, int $id, MyApi $api)
    {
        $response = $api->sendPut('skus', $id, $request->validated());
        
        // foreach ($request->file('image') as $image) {
        //     $file = $image->get();

        //     $response = Http::withHeaders([
        //         'Content-Type' => 'multipart/form-data',
        //     ])->attach(
        //         'image',
        //         $file,
        //     )->post('http://shopv5/api/images/3');
        // }
                
        if ($response['status'] == 200) {
            return redirect()->route('sku.index')->with('success', 'flushes.sku_updated '.$id);
        } else {
            return redirect()->route('sku.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->sendDelete('skus', $id);

        if ($response['status'] == 409) {
            return redirect()->route('sku.index')->with('danger', $response['body']);
        }
        return redirect()->route('sku.index')->with('danger', 'flushes.sku_deleted '.$id);
    }
}
