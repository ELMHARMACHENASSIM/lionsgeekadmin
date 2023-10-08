<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageClass extends Model
{
    use HasFactory;
    protected $fillable = [
        "classe_id",
        'images',
    ];
    public function classe(){
        return $this->belongsTo(Classe::class);
    }
}
