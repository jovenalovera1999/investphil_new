<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientHouse extends Model
{
    use HasFactory;

    protected $table = 'client_houses';
    protected $primaryKey = 'client_house_id';
    protected $guarded = [];
}
