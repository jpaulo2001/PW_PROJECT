<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
    use HasFactory, SoftDeletes;

    public function documentMetadata(){
        return $this->belongsToMany(DocumentMetadata::class);
    }


    public function historic(){
        return $this->hasMany(Historic::class);
    }

    public function documentPermitionType(){
        return $this->hasMany(DocumentPermitionType::class);
    }

    public function userDocument(){
        return $this->hasMany(UserDocument::class);
    }








}
