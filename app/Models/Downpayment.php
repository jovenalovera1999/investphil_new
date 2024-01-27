<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downpayment extends Model
{
    use HasFactory;

    protected $table = 'downpayments';
    protected $primaryKey = 'downpayment_id';
    protected $fillable = [
        'downpayment'
    ];
}
