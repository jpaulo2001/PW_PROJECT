<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Document extends Model
{
    use HasFactory, SoftDeletes;
    // adicionei isto aqui numa tentativa de funcionar
    protected $fillable = ['doc_name', 'type', 'author', 'proprietary'];


    public function documentMdata(){
        return $this->belongsToMany(DocumentMdata::class);
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
