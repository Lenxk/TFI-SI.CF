<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'supplier',
        'purchase_date',
        'total',
        'notes'
    ];

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
