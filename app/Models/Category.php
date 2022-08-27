<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categorys";
    protected $guarded = ['id'];
    use HasFactory;

    public function tours(){
        return $this->hasMany(Tour::class);
    }
}
