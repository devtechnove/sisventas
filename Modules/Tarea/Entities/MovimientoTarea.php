<?php

namespace Modules\Tarea\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MovimientoTarea extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        return \Modules\Tarea\Database\factories\MovimientoTareaFactory::new();
    }
}
