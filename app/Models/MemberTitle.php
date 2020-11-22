<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberTitle extends Model
{
    use HasFactory;

    public $table = "members_titles";

    protected $fillable = ['title1', 'title2'];


}
