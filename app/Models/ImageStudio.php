<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageStudio extends Model
{
    use HasFactory;
    protected $fillable = [
        "studio_id",
        'images',
    ];
    public function studio(){
        return $this->belongsTo(Studio::class);
    }
}
