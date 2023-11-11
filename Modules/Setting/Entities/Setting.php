<?php

namespace Modules\Setting\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Currency\Entities\Currency;
use App\Traits\Tenantable;

class Setting extends Model
{
    use HasFactory;

    protected $guarded = [];


    /**
     * Get the currency that owns the Setting
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function currency()
    {
        return $this->belongsTo(Currency::class, 'id');
    }

}
