<?php

namespace App\Models;

use App\Models\orderitem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class order extends Model
{
    use HasFactory;
    protected $table = 'orders';

    protected $fillable = [
        'fname',
        'lname',
        'email',
        'phone',
        'address1',
        'address2',
        'city',
        'state',
        'country',
        'pincode',
        'payment_mode',
        'payment_id',
        'status',
        'message',
        'total_price',
        'tracking_no',
    ];

    /**
     * Get all of the orderitem for the order
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderitem()
    {
        return $this->hasMany(orderitem::class);
    }
}
