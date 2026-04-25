<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Users;

class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product(){
        // return $this->hasOne('App\Models\Product', 'id', 'product_id');
        return $this->belongsTo(Product::class, 'product_id');
    }
}
