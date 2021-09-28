<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'users';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function speciesgroups()
    {
        return $this->hasManyThrough('App\Models\Speciesgroup', 'App\Models\SpeciesgroupUsers', 'user_id', 'speciesgroup_id', 'id', 'id');
    }
    public function countobjects()
    {
        return $this->hasManyThrough('App\Models\CountobjectUsers', 'App\Models\Countobject', 'user_id', 'countobject_id', 'id', 'id');
    }
    public function visits()
    {
        return $this->hasManyThrough('App\Models\VisitUsers', 'App\Models\Visit', 'user_id', 'visit_id', 'id', 'id');
    }
    public function observations()
    {
        return $this->hasManyThrough('App\Models\ObservationUsers', 'App\Models\Observation', 'user_id', 'observation_id', 'id', 'id');
    }
    public function regions()
    {
        return $this->hasManyThrough('App\Models\RegionsUsers', 'App\Models\Region', 'user_id', 'region_id', 'id', 'id');
    }
    public function measurements()
    {
        return $this->hasManyThrough('App\Models\MeasurementsUsers', 'App\Models\Measurements', 'user_id', 'measurement_id', 'id', 'id');
    }
}
