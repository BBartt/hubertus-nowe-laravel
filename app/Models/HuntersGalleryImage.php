<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HuntersGalleryImage extends Model
{
    use HasFactory;

    protected $fillable = ['hunters_gallery_id', 'image', 'description'];

    public function huntersGallery(){
      return $this->belongsTo('App\Models\HuntersGallery');
    }

}
