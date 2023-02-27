<?php

namespace App\Http\Controllers\Admin;

use App\Api\MyApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyRequest;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MyApi $api, $page = null)
    {
        $response = $api->getCollection('properties', $page);

        $properties = $response['body'];

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
    public function store(PropertyRequest $request, MyApi $api)
    {
        $response = $api->sendPost('properties', $request->validated());
        
        if ($response['status'] == 201) {
            return redirect()->route('property.index')->with('success', 'flushes.property_added '.$response['body']->name);
        } else {
            return redirect()->route('property.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->getItem('properties', $id);
        $property = $response['body'];
        
        return view('property.show', compact('property'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, MyApi $api)
    {
        $response = $api->getItem('properties', $id);
        $property = $response['body'];

        return view('property.form', compact('property'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PropertyRequest $request, int $id, MyApi $api)
    {
        $response = $api->sendPut('properties', $id, $request->validated());
        
        if ($response['status'] == 200) {
            return redirect()->route('property.index')->with('success', 'flushes.property_updated '.$id);
        } else {
            return redirect()->route('property.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->sendDelete('properties', $id);

        if ($response['status'] == 409) {
            return redirect()->route('property.index')->with('danger', $response['body']);
        }
        return redirect()->route('property.index')->with('danger', 'flushes.property_deleted '.$id);
    }
}
