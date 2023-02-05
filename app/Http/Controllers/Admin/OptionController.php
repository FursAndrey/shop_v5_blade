<?php

namespace App\Http\Controllers\Admin;

use App\Api\MyApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\OptionRequest;
use Illuminate\Http\Request;

class OptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $page = null, MyApi $api)
    {
        $response = $api->getCollection('options', $page);

        $options = $response['body'];
        
        return view('option.index', compact('options'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(MyApi $api)
    {
        $properties = $api->getCollection('property/all')['body'];
        return view('option.form', compact('properties'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OptionRequest $request, MyApi $api)
    {
        $response = $api->sendPost('options', $request->validated());

        if ($response['status'] == 201) {
            return redirect()->route('option.index')->with('success', 'flushes.option_added '.$response['body']->name);
        } else {
            return redirect()->route('option.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->getItem('options', $id);
        $option = $response['body'];
        
        return view('option.show', compact('option'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, MyApi $api)
    {
        $properties = $api->getCollection('property/all')['body'];
        
        $response = $api->getItem('options', $id);
        $option = $response['body'];
        
        return view('option.form', compact('option', 'properties'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OptionRequest $request, int $id, MyApi $api)
    {
        $response = $api->sendPut('options', $id, $request->validated());
        
        if ($response['status'] == 200) {
            return redirect()->route('option.index')->with('success', 'flushes.option_updated '.$id);
        } else {
            return redirect()->route('option.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->sendDelete('options', $id);

        if ($response['status'] == 409) {
            return redirect()->route('option.index')->with('danger', $response['body']);
        }
        return redirect()->route('option.index')->with('danger', 'flushes.option_deleted '.$id);
    }
}
