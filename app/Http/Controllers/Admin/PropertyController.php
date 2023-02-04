<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = null)
    {
        if (is_null($page)) {
            $url = 'http://shopv5/api/properties';
        } else {
            $url = 'http://shopv5/api/properties?page='.$page;
        }
        
        $resp = Http::acceptJson()->get($url);
        $properties = json_decode($resp->body());
        
        return view('property.index', compact('properties'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('property.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PropertyRequest $request)
    {
        $response = Http::post(
            'http://shopv5/api/properties', 
            $request->validated()
        );
        if ($response->status() == 201) {
            return redirect()->route('property.index')->with('success', 'flushes.property_added '.json_decode($response->body())->name);
        } else {
            return redirect()->route('property.index')->with('danger', 'Error. Status '.$response->status());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $response = Http::acceptJson()->get('http://shopv5/api/properties/'.$id);
        $property = json_decode($response->body());
        
        return view('property.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $resp = Http::acceptJson()->get('http://shopv5/api/properties/'.$id);
        $property = json_decode($resp->body());

        return view('property.form', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, int $id)
    {
        $response = Http::put(
            'http://shopv5/api/properties/'.$id, 
            $request->validated()
        );
        if ($response->status() == 200) {
            return redirect()->route('property.index')->with('success', 'flushes.property_updated '.$id);
        } else {
            return redirect()->route('property.index')->with('danger', 'Error. Status '.$response->status());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $response = Http::delete('http://shopv5/api/properties/'.$id);
        if ($response->status() == 409) {
            return redirect()->route('property.index')->with('danger', $response->body());
        }
        return redirect()->route('property.index')->with('danger', 'flushes.property_deleted '.$id);
    }
}