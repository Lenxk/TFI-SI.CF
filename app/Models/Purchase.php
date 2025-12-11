<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Purchase extends Model
{
    use Auditable;
    
    protected $fillable = [
        'supplier_id',
        'purchase_date',
        'total',
        'notes'
    ];

    public function supplier()
    {
    return $this->belongsTo(Supplier::class);
    }

    public function items()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
