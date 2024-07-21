<?php

namespace App\Traits;

trait CreatedBy
{
    public function bootCreatedBy()
    {
        static::creating(function ($model) {
            if (!$model->isDirty('created_by')) {
                $model->created_by = auth()->user()->id;
            }
        });
    }
}
