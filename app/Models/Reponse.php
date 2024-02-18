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
        'question_id',
        'conformite',
        'commentaire',
        'site',
 
    ];

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function mappingreponsespredefinedobs()
    {
        return $this->hasMany(mappingreponsespredefinedobs::class);
    }
    
    public function projects()
    {
        return $this->belongsTo(Project::class, 'project', 'id');
    }

    public function questions()
    {
        return $this->belongsTo(Question::class, 'question', 'id');
    }

    public function customer_sites()
    {
        return $this->belongsTo(Customer_site::class, 'site', 'ID');
    }

}
