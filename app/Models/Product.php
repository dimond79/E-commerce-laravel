<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','category_id','description','is_featured', 'price','sale_price','qty','featured_image','status'
    ];

    //realtion

    public function category()
    {
        return $this->belongsTo(ProductCategory::class,'category_id');
    }

}
