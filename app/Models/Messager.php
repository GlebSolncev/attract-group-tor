<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Messager extends Model
{
    protected
        $table = 'messager',
        $fillable = ['text', 'user_from_id', 'user_to_id'];
}
