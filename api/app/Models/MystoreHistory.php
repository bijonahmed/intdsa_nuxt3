<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MystoreHistory extends Model
{
    use HasFactory;
   
    public $table = "mystore_history";
    protected $fillable = ['user_id', 'service_id', 'mystore_id','service_price','category_id','status','duration','start_date','end_date'];
    
}
