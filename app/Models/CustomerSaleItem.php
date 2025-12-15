<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerSaleItem extends Model
{
    protected $fillable = [
        'customer_sale_id',
        'product_id',
        'quantity',
        'unit_price',
    ];

    public function sale()
    {
        return $this->belongsTo(CustomerSale::class, 'customer_sale_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
