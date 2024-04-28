<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mystore extends Model
{
    use HasFactory;
   
    public $table = "mystore";
    protected $fillable = ['user_id','category_id', 'status'];
    
}
