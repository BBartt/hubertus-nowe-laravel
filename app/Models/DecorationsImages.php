<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecorationsImages extends Model
{
    use HasFactory;

    public $table = "decorations_images";

    protected $fillable = ['decoration_id', 'image'];

    public function decoration(){
      return $this->belongsTo('App\Models\Decoration');
    }

}
