<?php

namespace Modules\Cuentas\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Cuentas\Entities\Cuentas;

class MovimientoCuentas extends Model
{
    use HasFactory;

    protected $fillable = [];

    public function cuenta()
    {
        return $this->belongsTo(Cuentas::class, 'cuenta_id', 'id');
    }
    

}
