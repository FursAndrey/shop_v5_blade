<?php

namespace App\Http\Controllers\Admin;

use App\Api\MyApi;
use App\Http\Controllers\Controller;
use App\Http\Requests\CurrencyRequest;

class CurrencyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($page = null, MyApi $api)
    {
        $response = $api->getCollection('currencies', $page);

        $currencies = $response['body'];
        
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
    public function store(CurrencyRequest $request, MyApi $api)
    {
        $response = $api->sendPost('currencies', $request->validated());

        if ($response['status'] == 201) {
            return redirect()->route('currency.index')->with('success', 'flushes.currency_added '.$response['body']->code);
        } else {
            return redirect()->route('currency.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->getItem('currencies', $id);
        $currency = $response['body'];
        
        return view('currency.show', compact('currency'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id, MyApi $api)
    {
        $response = $api->getItem('currencies', $id);
        $currency = $response['body'];

        return view('currency.form', compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CurrencyRequest $request, int $id, MyApi $api)
    {
        $response = $api->sendPut('currencies', $id, $request->validated());
        
        if ($response['status'] == 200) {
            return redirect()->route('currency.index')->with('success', 'flushes.currency_updated '.$response['body']->code);
        } else {
            return redirect()->route('currency.index')->with('danger', 'Error. Status '.$response['status']);
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
        $response = $api->sendDelete('currencies', $id);

        if ($response['status'] == 409) {
            return redirect()->route('currency.index')->with('danger', $response['body']);
        }
        return redirect()->route('currency.index')->with('danger', 'flushes.currency_deleted '.$id);
    }
}
