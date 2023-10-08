<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "reference",
        "type", 
        "quantite",
        "image",
        "nombre_utilisation",
        "disponible",
    ];

    public function reservationStudios()
    {
        return $this->belongsToMany(ReservationStudio::class, "reservation_studio_materials");
    }
}
