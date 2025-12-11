<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Sale extends Model
{
    use Auditable;
    
    protected $fillable = ['sale_date', 'total', 'notes'];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}

