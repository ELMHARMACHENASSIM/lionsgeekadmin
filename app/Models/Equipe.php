<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    use HasFactory;

    public function reservationStudios(){
        return $this->hasMany(ReservationStudio::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, "equipe_users");
    }
}
