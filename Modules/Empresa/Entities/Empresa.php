<?php

namespace Modules\Empresa\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use Modules\Planes\Entities\Planes;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected static function newFactory()
    {
        return \Modules\Empresa\Database\factories\EmpresaFactory::new();
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'empresa_id', 'id');
    }

    /**
     * Get the user that owns the Empresa
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function plan()
    {
        return $this->belongsTo(Planes::class, 'plan_id', 'id');
    }
}
