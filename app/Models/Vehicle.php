<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Vehicle extends Eloquent
{
    use HasFactory;

    protected $table = "vehicle";

    protected $primaryKey = "_id";

    protected $fillable = [
        'brand',
        'manufacturer',
        'price',
        'color',
        'year',
        'qty',
        'type'
    ];
}
