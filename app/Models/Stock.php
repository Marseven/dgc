<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Stock extends Model
{
    use HasFactory;

    public function entreprise(): BelongsTo
    {
        return $this->belongsTo(Entreprise::class, 'entreprise_id', 'id');
    }

    public function activity_st(): BelongsTo
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }

    public function type_declaration_st(): BelongsTo
    {
        return $this->belongsTo(DeclarationType::class, 'declaration_type_id', 'id');
    }

    public function type_product_st(): BelongsTo
    {
        return $this->belongsTo(ProductType::class, 'product_type_id', 'id');
    }

    public function logistic_st(): BelongsTo
    {
        return $this->belongsTo(Logistic::class, 'logistic_id', 'id');
    }
}
