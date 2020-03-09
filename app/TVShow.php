<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TVShow extends Model
{
    protected $fillable=["season","episode","quote"];
}
