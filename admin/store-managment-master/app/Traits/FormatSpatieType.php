<?php

namespace App\Traits;

use App\User;
use Illuminate\Support\Str;

trait FormatSpatieType
{
    public static function permissionName($value)
    {

        if (Str::contains($value, 'super-admin')) {
            return 'اضافة';
        }
        if (Str::contains($value, 'admin')) {
            return 'استعراض';
        }
        if (Str::contains($value, 'update')) {
            return 'تعديل';
        }
        if (Str::contains($value, 'delete')) {
            return 'حذف';
        }
    }
}






