<?php

namespace Modules\Currency\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Tenantable;
class Currency extends Model
{
    use HasFactory, Tenantable;

    protected $guarded = [];

}
