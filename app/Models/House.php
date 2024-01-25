<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class House extends Model
{
    use HasFactory;

    protected $table = 'houses';
    protected $primaryKey = 'house_id';
    protected $fillable = [
        'house_no',
        'category_id',
        'description',
        'price',
        'is_deleted'
    ];
}
