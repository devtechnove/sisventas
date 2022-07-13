<?php

namespace Modules\Sale\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contabilidad extends Model
{
   // use HasFactory;


    protected $table = "contabilidad";
    protected $primaryKey = "id";

    public $timestamps = false;

    protected $fillable=[   
        'denominacion', 
        'valor',
        'cantidad',
        'cantidad',
        'modo'
    ];

    protected $guarded=[

    ];
}
