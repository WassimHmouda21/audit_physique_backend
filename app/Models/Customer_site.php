<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_site extends Model
{
    use HasFactory;

    protected $table = 'customer_sites';

    protected $fillable = [
        'id',
        'Numero_site',
        'Structure',
        'Lieu',
        'Customer_Id',
        'Project_id'
    ];


    public function reponse()
    {
        return $this->hasMany(reponse::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_Id', 'id');
    }
    public function categories()
    {
        return $this->hasMany(Categorie::class, 'CustomerSite_Id', 'id');
    }
    public function project()
    {
        return $this->belongsTo(Project::class, 'Project_id', 'id');
    }
    
}
