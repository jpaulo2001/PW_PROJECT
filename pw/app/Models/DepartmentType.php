<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class DepartmentType extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = ["name","code"];

    public function department(){
        return $this->hasMany(Department::class);
    }





}
