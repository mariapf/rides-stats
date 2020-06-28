<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Scooter extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'name',
        'lat',
        'lng',
        'battery',
        'type',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];
}
