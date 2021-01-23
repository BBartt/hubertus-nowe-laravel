<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrophyGallery extends Model
{
    use HasFactory;

    public $table = "trophy_galleries";

    protected $fillable = ['name', 'thumbnail'];

    public function images(){
      return $this->hasMany('App\Models\TrophyGalleryImages');
    }

}
