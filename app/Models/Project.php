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
        'Preuve',
        'is_submitted'
    ];


    public function reponses()
    {
        return $this->hasMany(Reponse::class, 'projet_id' , 'id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function customer_sites()
    {
        return $this->hasMany(Customer_site::class);
    }
  
}
