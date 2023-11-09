<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentPermition extends Model
{
    use HasFactory, SoftDeletes;


    public function documentPermitionType(){
        return $this->hasMany(DocumentPermitionType::class);
    }
    
}
