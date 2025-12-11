<?php

namespace App\Traits;

use App\Models\Audit;
use Illuminate\Support\Facades\Auth;

trait Auditable
{
    public static function bootAuditable()
    {
        static::created(function ($model) {
            Audit::create([
                'user_id' => Auth::id(),
                'action' => 'created',
                'model' => class_basename($model),
                'model_id' => $model->id,
                'changes' => $model->getAttributes()
            ]);
        });

        static::updated(function ($model) {
            Audit::create([
                'user_id' => Auth::id(),
                'action' => 'updated',
                'model' => class_basename($model),
                'model_id' => $model->id,
                'changes' => $model->getChanges()
            ]);
        });

        static::deleted(function ($model) {
            Audit::create([
                'user_id' => Auth::id(),
                'action' => 'deleted',
                'model' => class_basename($model),
                'model_id' => $model->id,
                'changes' => null
            ]);
        });
    }
}
