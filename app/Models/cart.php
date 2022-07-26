<?php

namespace App\Models;

use App\Models\cart;
use App\Models\product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class cart extends Model
{
    use HasFactory;
    protected $table = 'carts';
    protected $fillable = [
        'user_id',
        'prod_id',
        'prod_qty',
    ];

    public function product(){
         /**
         * Get the user that owns the cart
         *
         * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
         */
        
            return $this->belongsTo(product::class, 'prod_id', 'id');
       
    }
}
