<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    
     protected $table = 'order_has_status';
     protected $fillable = ['order_id', 'status_id', 'user_id', 'comment'];

     public function order()
    {
      return $this->belongsTo('App\Order');
    }


}
