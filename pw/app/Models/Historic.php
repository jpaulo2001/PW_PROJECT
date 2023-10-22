<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Historic extends Model
{
    use HasFactory, SoftDeletes;



    public function historic(){
        return $this->belongsTo(Document::class);
    }

}
