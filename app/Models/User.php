<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
        'bith',
        'address',
        'role',
        'isEmailVerified'
    ];

    public function customers()
    {
        return $this->hasMany(Customer::class, 'Customer_Id', 'id');
    }

    // Define relationships, such as with other models, if needed
}
