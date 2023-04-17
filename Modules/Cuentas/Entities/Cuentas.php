<?php

namespace Modules\Cuentas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Tenantable;
class Cuentas extends Model
{
    use HasFactory, Tenantable;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Cuentas\Database\factories\CuentasFactory::new();
    }
}
