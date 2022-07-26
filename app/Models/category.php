<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    
    // protected $fillable = [
    //     'name',
    //     'slug',
    //     'description',
    //     'meta_title',
    //     'meta_descrip',
    //     'meta_keywords',
    //     'image',
    //     'status',
    //     'popular',
    // ];
}
