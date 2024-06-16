<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'stock_status_history';

    protected $fillable = [
        'old_status',
        'new_status',
        'message',
        'user_id',
        'stock_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'stock_id',
    ];
}
