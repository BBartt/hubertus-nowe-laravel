<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decoration extends Model
{
    use HasFactory;

    protected $fillable = [ 'title1', 'title2', 'not_trim_description', 'img1', 'img2', 'img3', 'img4', 'img5'];


}
