<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decoration extends Model
{
    use HasFactory;

    protected $fillable = [ 'title1', 'title2', 'not_trim_description' ];

    public function images(){
      return $this->hasMany('App\Models\DecorationsImages');
    }


}
