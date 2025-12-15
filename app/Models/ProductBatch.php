<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Carbon;
use App\Traits\Auditable;

class ProductBatch extends Model
{
    use Auditable;
    
    protected $fillable = [
        'product_id',
        'supplier_id',
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

    public function scopeExpired(Builder $query): Builder
    {
    return $query
        ->whereNotNull('expires_at')
        ->where('expires_at', '<', now()->startOfDay());
    }

    public function scopeExpiringSoon(Builder $query, int $days = 30): Builder
    {
    return $query
        ->whereNotNull('expires_at')
        ->whereBetween('expires_at', [
            now()->startOfDay(),
            now()->addDays($days)->endOfDay(),
        ]);
    }

    public function supplier()
    {
    return $this->belongsTo(Supplier::class);
    }

}
