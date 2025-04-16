<?php

namespace App\Http\Controllers;

use App\Models\Detail_sale;
use Illuminate\Http\Request;

class DetailSaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('module.dashboard.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Detail_sale $detail_sale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Detail_sale $detail_sale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Detail_sale $detail_sale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Detail_sale $detail_sale)
    {
        //
    }
}
