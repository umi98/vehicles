<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Motor extends Eloquent
{
    use HasFactory;

    protected $table = "detail_motor";

    protected $primaryKey = "_id";

    protected $fillable = [
        'machine',
        'suspension_front',
        'suspension_back',
        'transmission',
    ];
}
