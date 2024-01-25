<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'id',
        'reponse',
        'Path',
       
    ];

    public function reponse()
    {
        return $this->belongsTo(Reponse::class, 'reponse', 'id');
    }
}
