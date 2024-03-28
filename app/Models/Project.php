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


    public function reponse()
    {
        return $this->hasMany(reponse::class);
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
