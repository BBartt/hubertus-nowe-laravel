<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PartyImage extends Model
{
    use HasFactory;

    public $table = "parties_images";

    protected $fillable = ['party_id', 'image'];

    public function party(){
      return $this->belongsTo('App\Models\Party');
    }

}
