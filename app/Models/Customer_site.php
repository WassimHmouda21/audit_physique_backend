<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_site extends Model
{
    use HasFactory;

    protected $table = 'customer_sites';

    protected $fillable = [
        'ID',
        'Numero_site',
        'Structure',
        'Lieu',
        'Customer_Id',
    ];


    public function reponse()
    {
        return $this->hasMany(reponse::class);
    }
    
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'Customer_Id', 'id');
    }
    
}
