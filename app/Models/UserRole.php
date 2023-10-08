<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "role_id",
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, "user_roles");
    }
}
