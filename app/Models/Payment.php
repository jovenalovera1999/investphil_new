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
        'payment_method_id',
        'invoices',
        'client_house_id',
        'downpayment_id',
        'monthly_paid',
        'is_fully_paid',
        'is_deleted'
    ];
}
