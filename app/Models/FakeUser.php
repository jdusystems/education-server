<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FakeUser extends Model
{
    use HasFactory;
    protected $table = "fake_users";
    protected $fillable = [
        'name',
        'phone_number',
        'password',
        'code'
    ];
}
