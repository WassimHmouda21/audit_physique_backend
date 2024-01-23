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
        'SecteurActivite',
        'Categorie',
        'Site Web',
        'Adresse mail', // Corrected typo here
        'Organigramme',
        'Network_Design',
        'Type'
    ];

    public function customer_sites()
    {
        return $this->hasMany(Customer_site::class, 'Customer_Id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
