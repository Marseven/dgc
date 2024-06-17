<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Importation extends Model
{
    use HasFactory;

    public function entreprise()
    {
        return $this->belongsTo(Entreprise::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'updated_by', 'id');
    }

    public function approved_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by', 'id');
    }
}
