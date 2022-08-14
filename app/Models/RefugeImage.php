<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RefugeImage extends Model
{
    use HasFactory;

    protected $fillable = ['refuge_id', 'image'];

    public function party(){
      return $this->belongsTo('App\Models\Refuge');
    }

}
