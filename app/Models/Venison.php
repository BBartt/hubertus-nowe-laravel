<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venison extends Model
{
    use HasFactory;

    public $table = 'venisons';

    protected $fillable = ['name', 'image', 'interval', 'price'];


}
