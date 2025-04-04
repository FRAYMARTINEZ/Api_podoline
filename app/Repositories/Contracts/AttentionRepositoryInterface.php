<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface AttentionRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function store(Request $data);
    public function update(int $id, Request $data);
    public function delete(int $id);
}
