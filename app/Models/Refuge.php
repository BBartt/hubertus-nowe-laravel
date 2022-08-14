<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refuge extends Model
{
    use HasFactory;

    protected $fillable = ['description'];

    public function refugeImage(){
      return $this->hasMany('App\Models\RefugeImage');
    }

}
