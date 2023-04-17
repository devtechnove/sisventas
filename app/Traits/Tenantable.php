<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

trait Tenantable
{
    protected static function bootTenantable(): void
    {
        if (app()->runningInConsole()) {
            return;
        }

        static::creating(function (Model $model) {
            if (!auth()->check()) {
                return;
            }

            $model->empresa_id = \Auth::user()->empresa_id;
        });

        static::addGlobalScope('user_filter', function (Builder $builder) {

                 $builder->where((new static())->getTable() . '.empresa_id', \Auth::user()->empresa_id);

        });
    }
}
