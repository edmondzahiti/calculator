<?php

namespace App\Repositories;

use App\Models\History;

class HistoryRepository
{
    protected $model;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    public function getModel(): History
    {
        return new History();
    }

    public function get()
    {
        return $this->model->orderBy('id', 'desc')->get();
    }

    public function log($data): History
    {
        return $this->model->create($data);
    }
}
