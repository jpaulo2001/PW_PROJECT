<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Mdata extends Model
{
    use HasFactory, SoftDeletes;


    public function documentMetadata(){
        return $this->hasMany(DocumentMdata::class);
    }



}
