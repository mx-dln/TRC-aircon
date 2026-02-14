<?php

namespace App\Models;

use App\Models\PriceType;
use App\Models\ProductType;
use App\Models\ProductPrice;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected static function booted()
    // {
    //     // Auto-create prices when product is created
    //     // static::created(function ($product) {
    //     //     foreach (PriceType::all() as $type) {
    //     //         $product->prices()->firstOrCreate([
    //     //             'price_type_id' => $type->id,
    //     //         ]);
    //     //     }
    //     // });
    // }

    protected $fillable = [
        'brand_id',
        'product_type_id',
        'image_path',
        'capacity',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id', 'id');
    }

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'product_id', 'id');
    }

    public function price($code)
    {
        return $this->prices
            ->first(fn($p) => $p->priceType->code === $code)
            ?->price;
    }

}
