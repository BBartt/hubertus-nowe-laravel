<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecorationsTitlesAndImages extends Model
{
    use HasFactory;

    public $table = "decorations_titles_and_images";

    protected $fillable = ['title1', 'title2'];


}
