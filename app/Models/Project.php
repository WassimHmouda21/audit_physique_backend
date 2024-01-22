<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $table = 'projects';

    protected $fillable = [
        'id',
        'Nom',
        'URL',
        'Description',
        'customer_id',
        'year',
        'QualityChecked',
        'QualityCheckedDateTime',
        'QualityCheckedMessage',
        'Preuve'


    ];
}
