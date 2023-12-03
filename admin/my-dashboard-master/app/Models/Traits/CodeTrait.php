<?php

namespace App\Models\Traits;

use App\Observers\CodeObserver;

trait CodeTrait
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::observe(CodeObserver::class);
    }
}
