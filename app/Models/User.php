<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;



class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    // Define the table associated with the model
    protected $table = 'users';

    // Specify the fillable attributes
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'is_verified',
    ];

    // Specify the hidden attributes
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Relation with the EmailVerification model
    public function emailVerification()
    {
        return $this->hasOne(EmailVerification::class);
    }
}