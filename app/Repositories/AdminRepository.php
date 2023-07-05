<?php

namespace App\Repositories;

use App\Models\Admin;
use App\Repositories\BaseEloquentRepository\BaseEloquentRepository;

class AdminRepository extends BaseEloquentRepository
{
    public function getModel()
    {
        return Admin::class;
    }
}
