<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipeUser extends Model
{
    use HasFactory;

    protected $fillable = [
        "equipe_id",
        "user_id",
    ];
}
