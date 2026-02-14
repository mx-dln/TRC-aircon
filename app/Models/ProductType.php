<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'name',
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'product_type_id', 'id');
    }

}
