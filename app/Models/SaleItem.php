<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class SaleItem extends Model
{
    use Auditable;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'unit_price'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
