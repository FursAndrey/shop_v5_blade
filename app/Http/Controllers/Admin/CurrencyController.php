<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;
use Illuminate\Support\Facades\Http;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = null)
    {
        if (is_null($page)) {
            $url = 'http://shopv5/api/currencies';
        } else {
            $url = 'http://shopv5/api/currencies?page='.$page;
        }
        
        $resp = Http::acceptJson()->get($url);
        $currencies = json_decode($resp->body());
        
        return view('currency.index', compact('currencies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('currency.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CurrencyRequest $request)
    {
        $response = Http::post(
            'http://shopv5/api/currencies', 
            $request->validated()
        );
        if ($response->status() == 201) {
            return redirect()->route('currency.index')->with('success', 'flushes.currency_added '.json_decode($response->body())->code);
        } else {
            return redirect()->route('currency.index')->with('danger', 'Error. Status '.$response->status());
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
        $response = Http::acceptJson()->get('http://shopv5/api/currencies/'.$id);
        $currency = json_decode($response->body());
        
        return view('currency.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $resp = Http::acceptJson()->get('http://shopv5/api/currencies/'.$id);
        $currency = json_decode($resp->body());

        return view('currency.form', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, int $id)
    {
        $response = Http::put(
            'http://shopv5/api/currencies/'.$id, 
            $request->validated()
        );
        if ($response->status() == 200) {
            return redirect()->route('currency.index')->with('success', 'flushes.currency_updated '.json_decode($response->body())->code);
        } else {
            return redirect()->route('currency.index')->with('danger', 'Error. Status '.$response->status());
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
        $response = Http::delete('http://shopv5/api/currencies/'.$id);
        if ($response->status() == 409) {
            return redirect()->route('currency.index')->with('danger', $response->body());
        }
        return redirect()->route('currency.index')->with('danger', 'flushes.currency_deleted '.$id);
    }
}
