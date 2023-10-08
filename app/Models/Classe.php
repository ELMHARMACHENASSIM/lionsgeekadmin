<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "disponible",
        "nombre_utilisation",
    ];

    public function images()
    {
        return $this->hasMany(ImageClass::class);
    }

    public function reservationClasses()
    {
        return $this->hasMany(ReservationClasse::class);
    }
}
