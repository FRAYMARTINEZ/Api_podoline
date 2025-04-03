<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface AttentionRepositoryInterface
{
    public function all();
    public function find($id);
    public function store(Request $data);
    public function update($id, Request $data);
    public function delete($id);
}
