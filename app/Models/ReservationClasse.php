<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReservationClasse extends Model
{
    use HasFactory;

    protected $fillable =[
        "user_id",
        "title",
        "description",
        "classe_id",
        "start_time",
        "finish_time",
        "cancel",
    ];

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
