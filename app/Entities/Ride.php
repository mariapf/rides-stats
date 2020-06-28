<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Ride extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'scooter_id',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
