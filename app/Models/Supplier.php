<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Auditable;

class Supplier extends Model
{
    use Auditable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address'
    ];

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
