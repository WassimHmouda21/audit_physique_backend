<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $table = 'questions';

    protected $fillable = [
        'id',
        'ordre',
        'Ref',
        'Question',
        'categorie'


    ];

    
    public function reponses()
    {
        return $this->hasMany(Customer_site::class);
    }

    public function predefined_observations()
    {
        return $this->hasMany(Project::class);
    }

    public function categories()
    {
        return $this->belongsTo(Categorie::class, 'categorie', 'id');
    }
}
