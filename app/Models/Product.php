<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Product extends Model
{
     use Auditable;
     
    protected $fillable = [
    'name',
    'description',
    'price',
    'stock',
    'min_stock',   
    'image',
    'category_id',
];


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function batches()
    {
    return $this->hasMany(ProductBatch::class);
    }

        public function scopeLowStock($query)
    {
    return $query
        ->where('min_stock', '>', 0)
        ->whereColumn('stock', '<=', 'min_stock');
    }
}

