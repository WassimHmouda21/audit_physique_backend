<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Predefined_observations extends Model
{
        use HasFactory;
    
        protected $table = 'predefined_observations';  
        protected $fillable = [
            'id',
            'objet',
            'question_id',
        ];
    
        public function question()
        {
            return $this->belongsTo(Question::class, 'question_id', 'id');
        }
    
        public function mappingreponsespredefinedobs()
        {
            return $this->hasMany(Mappingreponsespredefinedobs::class);
        }
    
    
   
}
