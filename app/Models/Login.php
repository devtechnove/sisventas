<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Tenantable;

class Login extends Model
{
    use HasFactory, Tenantable;


     protected $dates = ['login_at', 'logout_at'];

    protected $searchable = [

       'columns' => [
           'users.name' => 5,
           'users.lastname' => 5,
       ],
       'joins' => [
           'users' => ['users.id','logins.user_id'],
       ],
    ];

    /*
    |
    | ** Relationships model **
    |
    */

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /*
    |
    | ** Scopes model **
    |
    */

    public function scopeWithUser($query)
    {
       return $query->with(['user' => function ($q) {
                   $q->select(['id', 'name', 'lastname']);
              }]);
    }
}
