<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
   
    public $table = "orders";
    protected $fillable = ['orderId', 'user_id', 'product_id','product_name','selling_price','buying_price','profit','order_date','product_qty','status','thumnail_img','user_balance','user_mul_balance','order_inactive_time','created_at'];
    
}

