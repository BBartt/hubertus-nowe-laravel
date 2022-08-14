<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    // public $table = "gallery";

    protected $fillable = ['name', 'thumbnail'];

    public function images(){
      return $this->hasMany('App\Models\Image');
    }


}
