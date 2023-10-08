<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationStudio extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "title",
        "description",
        "studio_id",
        "start_time",
        "finish_time",
        "equipe_id",
        "cancel",

    ];

    public function materials()
    {
        return $this->belongsToMany(Material::class, "reservation_studio_materials");
    }

    public function studio()
    {
        return $this->belongsTo(Studio::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function equipe()
    {
        return $this->belongsTo(Equipe::class);
    }

}
