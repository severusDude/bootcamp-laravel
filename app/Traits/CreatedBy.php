<?php

namespace App\Traits;

trait CreatedBy
{
    public static function bootCreatedBy()
    {
        static::creating(function ($model) {
            if (!$model->isDirty('user_id')) {
                $model->user_id = auth()->user()->id;
            }
        });
    }
}
