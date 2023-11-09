<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DocumentPermitionType extends Model
{
    use HasFactory, SoftDeletes;

    public function documentPermition(){
        return $this->belongsTo(DocumentPermition::class);
    }

    public function document(){
        return $this->belongsTo(Document::class);
    }

}
