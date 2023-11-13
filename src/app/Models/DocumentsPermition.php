<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentsPermition extends Model
{
    use HasFactory, SoftDeletes;


    public function documentPermitionType(){
        return $this->hasMany(DocumentPermitionType::class);
    }

}
