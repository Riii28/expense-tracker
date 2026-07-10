<?php

namespace App\Services;

use App\Models\Task;

class TaskService
{
    public function getAll(int $limit = 10)
    {
        return Task::query()->paginate($limit);
    }
}
