<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Selling extends Eloquent
{
    use HasFactory;

    protected $table = "selling";

    protected $primaryKey = "_id";

    protected $fillable = [
        'date',
        'vehicle_id',
        'color',
        'qty'
    ];
}
