<?php

namespace Modules\Tarea\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Personal\Entities\Personal;
use App\Traits\Tenantable;
class Tarea extends Model
{
    use HasFactory, Tenantable;

    protected $fillable = [];

   /**
    * Get the user that owns the Tarea
    *
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
   public function personal()
   {
       return $this->belongsTo(Personal::class, 'personal_id');
   }
}
