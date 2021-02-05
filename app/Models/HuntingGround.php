<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HuntingGround extends Model
{
    use HasFactory;

    public $table = "hunting_ground_images";

    protected $fillable = ['images', 'image'];


}
