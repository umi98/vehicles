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
        'vehicle_id',
        'type',
        'qty',
        'payment_method',
        'tax',
        'buyer[]'
    ];
}
