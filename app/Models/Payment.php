<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payments';
    protected $primaryKey = 'payment_id';
    protected $fillable = [
        'invoices',
        'user_id',
        'house_id',
        'amount',
        'change',
        'is_deleted'
    ];
}
