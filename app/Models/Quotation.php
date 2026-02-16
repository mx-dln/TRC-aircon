<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $fillable = [
        'project_name',
        'address',
        'contact_no',
        'contact_person',
        'email',
        'quotation_no',
        'total_amount',
        'status',
    ];

    public function items()
    {
        return $this->hasMany(QuotationItem::class);
    }

    public function getTotalAmountAttribute()
    {
        return $this->items->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });
    }

    public function calculateTotal()
    {
        $this->total_amount = $this->getTotalAmountAttribute();
        $this->save();
    }
}
