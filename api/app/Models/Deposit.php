<?php

namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AttributeValues;
use AuthorizesRequests;
use DB;

class Deposit extends Authenticatable
{
  use HasApiTokens, HasFactory, Notifiable;
  public $table = "deposit";

  protected $fillable = [
    'depositID',
    'order_no',
    'depscription',
    'user_id',
    'deposit_amount',
    'receivable_amount',
    'payment_method',
    'approved_by',
    'status',
  ];
}
