<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    // public $table = 'party';

    protected $fillable = ['description', 'link_1', 'link_2', 'link_3', 'link_4', 'link_5'];

    public function partyImages(){
      return $this->hasMany('App\Models\PartyImage');
    }

}
