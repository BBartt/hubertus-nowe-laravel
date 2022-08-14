<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurDogs extends Model
{
    use HasFactory;

    public $table = "our_dogs";

    protected $fillable = ['image', 'description'];


}
