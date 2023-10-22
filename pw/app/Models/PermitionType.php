<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PermitionType extends Model
{
    use HasFactory, SoftDeletes;


    public function permition(){
        return $this->belongsTo(Permition::class);
    }


}
