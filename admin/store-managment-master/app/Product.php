<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $guarded = [];
    protected $with = ['category'];

    public function setSubcategoryIdAttribute($value)
    {

        ($value != 'null') ? $this->attributes['subcategory_id'] = $value : $this->attributes['subcategory_id'] = null ;

    }

    public function getImageAttribute(){

        return $this->getFirstMediaUrl('products');

    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function setTotalPrice($weight, $addedValue, $deducted_value, $price)
    {
        return ($weight * $this->category->gram_price) + $price + $addedValue - $deducted_value;
    }
}
