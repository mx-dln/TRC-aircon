<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuotationItem extends Model
{
    protected $fillable = [
        'quotation_id',
        'product_id',
        'quantity',
        'unit',
        'unit_price',
        'amount',
    ];

    protected $casts = [
        'unit_price' => 'decimal:2',
        'amount' => 'decimal:2',
    ];

    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getItemDescriptionAttribute()
    {
        return $this->product ? $this->product->type->name . ' - ' . $this->product->brand->name . ' (' . $this->product->capacity . ')' : 'N/A';
    }

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($item) {
            // Get unit price from product SRP if not set
            if ($item->product && !$item->unit_price) {
                $item->unit_price = $item->product->price('srp') ?? 0;
            }
            
            // Calculate amount automatically
            $item->amount = $item->quantity * $item->unit_price;
        });

        static::saved(function ($item) {
            // Recalculate quotation total when item is saved
            $item->quotation->calculateTotal();
        });

        static::deleted(function ($item) {
            // Recalculate quotation total when item is deleted
            $item->quotation->calculateTotal();
        });
    }
}
