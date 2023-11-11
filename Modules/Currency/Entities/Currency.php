<?php

namespace Modules\Currency\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\Tenantable;
class Currency extends Model
{
    use HasFactory, Tenantable;

    protected $guarded = [];

    /**
     * Get all of the settings for the Currency
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings()
    {
        return $this->hasMany(Setting::class, 'currency_id', 'id');
    }
}
