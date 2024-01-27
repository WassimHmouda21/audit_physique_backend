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
            'categorie',
        ];
    
        public function reponses()
        {
            return $this->hasMany(Reponse::class);
        }

        public function predefined_observations()
        {
            return $this->hasMany(Predefined_observations::class, 'question_id', 'id');
        }
    
        public function categories()
        {
            return $this->belongsTo(Categorie::class, 'categorie', 'id');
        }
    }
    
 