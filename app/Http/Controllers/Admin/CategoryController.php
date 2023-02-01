<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
    public function store(Request $request)
    {
        dd('store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resp = Http::acceptJson()->get('http://shopv5/api/categories/'.$id);
        $category = json_decode($resp->body());
        // dd($category);
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
    public function update(Request $request, $id)
    {
        dd('update');
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
        return redirect()->route('category.index')->with('danger', __('flushes.category_deleted', ['category' => $id]));
    }
}
