<?php

namespace App\Http\Controllers;

use App\Models\Attention;
use App\Http\Requests\StoreAttentionRequest;
use App\Http\Requests\UpdateAttentionRequest;

class AttentionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAttentionRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Attention $attention)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAttentionRequest $request, Attention $attention)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attention $attention)
    {
        //
    }
}
