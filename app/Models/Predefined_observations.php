<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predefined_observations extends Model
{
    use HasFactory;

    protected $table = 'images';

    protected $fillable = [
        'id',
        'objet',
        'question',
       
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'reponse', 'id');
    }

    public function mappingreponsespredefinedobs()
    {
        return $this->hasMany(Project::class);
    }
}
