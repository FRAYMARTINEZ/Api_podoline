<?php

namespace App\Services;

use App\Models\Attention;
use App\Repositories\AttentionRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class AttentionService
{
    protected $attentionRepository;

    public function __construct(AttentionRepository $attentionRepository)
    {
        $this->attentionRepository = $attentionRepository;
    }

    public function all()
    {
        return $this->attentionRepository->all();
    }

    public function find(int $id)
    {
        return $this->attentionRepository->find($id);
    }

    public function store(Request $data)
    {
        return $this->attentionRepository->store($data);
    }

    public function update(int $id, Request $data)
    {
        return $this->attentionRepository->update($id, $data);
    }

    public function delete(int $id): bool
    {
        return $this->attentionRepository->delete($id);
    }
}
