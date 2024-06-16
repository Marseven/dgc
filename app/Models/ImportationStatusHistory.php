<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportationStatusHistory extends Model
{
    use HasFactory;

    protected $table = 'importation_status_history';

    protected $fillable = [
        'old_status',
        'new_status',
        'message',
        'user_id',
        'importation_id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'user_id',
        'importation_id',
    ];
}
