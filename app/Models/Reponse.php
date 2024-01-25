<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reponse extends Model
{
    use HasFactory;

    protected $table = 'reponses';

    protected $fillable = [
        'id',
        'projet',
        'question',
        'conformite',
        'commentaire',
        'site',
 
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
