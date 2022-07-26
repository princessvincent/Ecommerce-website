<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $fillable =  [
        'cate_id',
        'name',
        'slug',
        'small_description',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'tax',
        'status',
        'trending',
        'metal_title',
        'metal_keywords',
        'metal_description',
    ];

    public function category(){
        return $this->belongsTo(category::class, 'cate_id', 'id');
        
    }
}
