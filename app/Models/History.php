<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    public $table = "histories";

    protected $fillable = ['description', 'link1', 'link2', 'link3', 'linkName1', 'linkName2', 'linkName3'];

    public function historyImages(){
      return $this->hasMany('App\Models\HistoryImages');
    }


}
