<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Restorant ;

class Lists extends Model
{
    use HasFactory;
     protected $table = 'lists';
      protected $fillable = [
        'restaurant_id', 'user_id','category',
    ];
       
          public function restorant()
    {
        return $this->hasOne(\App\Restorant::class, 'id', 'restaurant_id');
    }
}
