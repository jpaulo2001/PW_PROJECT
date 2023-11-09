<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    use HasFactory, SoftDeletes;


    public function userTypePermition(){
        return $this->hasMany(UserTypePermition::class);
    }


    public function user(){
        return $this->hasMany(User::class);
    }
}
