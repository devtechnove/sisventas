<?php

namespace Modules\Personal\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Tenantable;
class Personal extends Model
{
    use HasFactory, Tenantable;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Personal\Database\factories\PersonalFactory::new();
    }
}
