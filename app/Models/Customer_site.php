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
}
