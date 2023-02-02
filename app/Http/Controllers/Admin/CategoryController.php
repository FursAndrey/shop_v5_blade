<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resp = Http::acceptJson()->get('http://shopv5/api/categories');
        $categories = json_decode($resp->body());
        // dd($categories);
//ДОДЕЛАТЬ ПАГИНАЦИЮ
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
    public function store(CategoryRequest $request)
    {
        $response = Http::post(
            'http://shopv5/api/categories', 
            [
                'name' => $request->name,
            ]
        );
        if ($response->status() == 201) {
            return redirect()->route('category.index')->with('success', 'flushes.category_added '.json_decode($response->body())->name);
        } else {
            return redirect()->route('category.index')->with('danger', 'Error. Status '.$response->status());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $response = Http::acceptJson()->get('http://shopv5/api/categories/'.$id);
        $category = json_decode($response->body());
        
        return view('category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $resp = Http::acceptJson()->get('http://shopv5/api/categories/'.$id);
        $category = json_decode($resp->body());

        return view('category.form', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $response = Http::put(
            'http://shopv5/api/categories/'.$id, 
            [
                'name' => $request->name,
            ]
        );
        if ($response->status() == 200) {
            return redirect()->route('category.index')->with('success', 'flushes.category_updated '.$id);
        } else {
            return redirect()->route('category.index')->with('danger', 'Error. Status '.$response->status());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = Http::delete('http://shopv5/api/categories/'.$id);
        if ($response->status() == 409) {
            return redirect()->route('category.index')->with('danger', $response->body());
        }
        return redirect()->route('category.index')->with('danger', 'flushes.category_deleted '.$id);
    }
}
