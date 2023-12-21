<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    use HasFactory;

    // Define the table associated with the model
    protected $table = 'email_verifications';

    // Specify the fillable attributes
    protected $fillable = [
        'user_id',
        'otp',
    ];

    // Relation with the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}