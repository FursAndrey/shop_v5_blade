<?php

namespace App\Http\Controllers\Admin;

use App\Api\MyApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(MyApi $api, $page = null)
    {
        $response = $api->getCollection('categories', $page);

        $categories = $response['body'];
        
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, MyApi $api)
    {
        $response = $api->sendPost('categories', $request->validated());

        if ($response['status'] == 201) {
            return redirect()->route('category.index')->with('success', 'flushes.category_added '.$response['body']->name);
        } else {
            return redirect()->route('category.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->getItem('categories', $id);
        $category = $response['body'];
        
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, MyApi $api)
    {
        $response = $api->getItem('categories', $id);
        $category = $response['body'];

        return view('category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, int $id, MyApi $api)
    {
        $response = $api->sendPut('categories', $id, $request->validated());
        
        if ($response['status'] == 200) {
            return redirect()->route('category.index')->with('success', 'flushes.category_updated '.$id);
        } else {
            return redirect()->route('category.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->sendDelete('categories', $id);

        if ($response['status'] == 409) {
            return redirect()->route('category.index')->with('danger', $response['body']);
        }
        return redirect()->route('category.index')->with('danger', 'flushes.category_deleted '.$id);
    }
}
