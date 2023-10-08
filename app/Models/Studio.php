<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Studio extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "disponible",
        "nombre_utilisation", 
    ];
    
    public function images()
    {
        return $this->hasMany(ImageStudio::class);
    }

    public function reservationStudios()
    {
        return $this->hasMany(ReservationStudio::class);
    }
}
