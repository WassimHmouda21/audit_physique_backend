<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customers';

    protected $fillable = [
        'id',
        'SN',
        'LN',
        'Logo',
        'Description',
        'user_id',
        'SecteurActivite',
        'Categorie',
        'Site_Web',
        'Adresse_mail', // Corrected typo here
        'Organigramme',
        'Network_Design',
        'Type'
    ];

    public function customer_sites()
    {
        return $this->hasMany(Customer_site::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
   
}
