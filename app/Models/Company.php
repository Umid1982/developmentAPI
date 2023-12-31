<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'logo',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class, 'company_id', 'id');
    }

    public function company()
    {
        return $this->hasOne(Company::class);
    }
}
