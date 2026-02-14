<?php

namespace App\Models;

use App\Models\ProductPrice;
use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    protected $fillable = [
        'code',
        'label',
    ];

    public function prices()
    {
        return $this->hasMany(ProductPrice::class, 'price_type_id', 'id');
    }

}
