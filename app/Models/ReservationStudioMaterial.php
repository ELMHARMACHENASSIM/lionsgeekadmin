<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStudioMaterial extends Model
{
    use HasFactory;

    protected $fillable = [
        "reservation_studio_id",
        "material_id",
    ];
}
