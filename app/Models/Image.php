<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $table = "images";

    protected $fillable = ['gallery_id', 'image', 'description'];

    public function gallery(){
      return $this->belongsTo('App\Models\Gallery');
    }

}
