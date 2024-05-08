<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @OA\Schema(
 *     type="object",
 *     title="Role",
 * )
 */

class Role extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'user_type_id',
        'deleted',
        'deleted_at'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'user_type_id'
    ];

    /**
     * @OA\Property(
     *     property="id",
     *     description="Role's id",
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
     *     description="Role's name",
     *     type="string",
     * )
     */

    public $name;

    /**
     * @OA\Property(
     *     property="description",
     *     description="Role's description",
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
    public function user_type()
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }

    /**
     * @OA\Property(
     *     property="privileges",
     *     description="Array of Privilege Model",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/Privilege")
     * )
     */
    public function privileges()
    {
        return $this->belongsToMany(Privilege::class, 'role_privileges', 'role_id', 'privilege_id');
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles', 'role_id', 'user_id');
    }
}
