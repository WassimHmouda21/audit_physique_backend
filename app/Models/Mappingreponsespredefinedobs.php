<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mappingreponsespredefinedobs extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'id',
        'reponse',
        'predefinedObs',
       
    ];
}
