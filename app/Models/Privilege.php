<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Privilege",
 * )
 */

class Privilege extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_type_id',
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'user_type_id'
    ];

    /**
     * @OA\Property(
     *     property="id",
     *     description="Privilege's id",
     *     type="integer",
     * )
     */

     public function getIdAttribute()
     {
         return $this->attributes['id'];
     }

    /**
     * @OA\Property(
     *     property="name",
     *     description="Privilege's name",
     *     type="string",
     * )
     */

     public $name;

         /**
     * @OA\Property(
     *     property="description",
     *     description="Privilege's description",
     *     type="string",
     * )
     */

     public $description;

    /**
     * @OA\Property(
     *     property="user_type",
     *     description="UserType Model",
     *     type="Object",
     *     ref="#/components/schemas/UserType"
     * )
     */
    public function user_type():BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }
}
