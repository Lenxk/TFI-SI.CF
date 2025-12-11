<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSale extends Model
{
    protected $fillable = [
        'sale_date',
        'total',
        'notes',
    ];

    public function items()
    {
        return $this->hasMany(CustomerSaleItem::class);
    }
}
