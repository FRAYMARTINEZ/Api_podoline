<?php

namespace App\Http\Controllers;

use App\Models\Attention;
use App\Http\Requests\StoreAttentionRequest;
use App\Http\Requests\UpdateAttentionRequest;
use App\Services\AttentionService;
use Illuminate\Http\Request;

class AttentionController extends Controller
{

    protected $serviceAttention;

    public function __construct(AttentionService $serviceAttention)
    {
        $this->serviceAttention = $serviceAttention;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        return $this->serviceAttention->all($request);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return $this->serviceAttention->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return $this->serviceAttention->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        return $this->serviceAttention->update($id, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        return $this->serviceAttention->delete($id);
    }
}
