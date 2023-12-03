<?php

namespace App\Observers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CodeObserver
{
    public function creating(Model $model)
    {
        $model->uuid = Str::uuid();
    }
}
