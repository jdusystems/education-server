<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Education extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'name',
        'phone_number',
        'website',
        'instagram',
        'telegram',
        'youtube',
        'facebook',
        'bio',
        'certificate',
        'logo',
        'location',
        'address',
        'user_id',
        'category_id',
        'district_id',
    ];
    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
