<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{
    protected $fillable = [
        'product_id',
        'supplier',
        'lot_code',
        'quantity',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'date',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
