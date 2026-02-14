<?php

namespace App\Models;

use App\Models\PriceType;
use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{
    protected $attributes = [
        'price' => 0,
    ];

    protected $fillable = [
        'product_id',
        'price_type_id',
        'price',
    ];

    public function priceType()
    {
        return $this->belongsTo(PriceType::class, 'price_type_id', 'id');
    }

}
