<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrophyGalleryImages extends Model
{
    use HasFactory;

    public $table = "trophy_images";

    protected $fillable = ['trophy_gallery_id', 'image', 'description'];

    public function gallery(){
      return $this->belongsTo('App\Models\TrophyGallery');
    }


}
