<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorie extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'id',
        'Nom',
        'CustomerSite_Id',
   
    ];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    public function customer_site()
    {
        return $this->belongsTo(Customer_site::class, 'CustomerSite_Id', 'id');
    }
}
