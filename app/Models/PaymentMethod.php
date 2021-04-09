<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'desc', 'type', 'status', ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
