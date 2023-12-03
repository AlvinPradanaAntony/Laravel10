<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $guarded = [];

    public function setGramPriceAttribute($value)
    {
        ($value == null) ? $this->attributes['gram_price'] = 1 : $this->attributes['gram_price'] = $value ;

    }

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
