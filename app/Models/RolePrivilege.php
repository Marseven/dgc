<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @OA\Schema(
 *     type="object",
 *     title="RolePrivilege",
 * )
 */

class RolePrivilege extends Model
{
    use HasFactory;

    protected $fillable = [
        'privilege_id',
        'role_id',
        'user_type_id'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'privilege_id',
        'role_id',
        'user_type_id'
    ];

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

    /**
     * @OA\Property(
     *     property="role",
     *     description="Role Model",
     *     type="Object",
     *     ref="#/components/schemas/Role"
     * )
     */
    public function role():BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

        /**
     * @OA\Property(
     *     property="privilege",
     *     description="Privilege Model",
     *     type="Object",
     *     ref="#/components/schemas/Privilege"
     * )
     */
    public function privilege():BelongsTo
    {
        return $this->belongsTo(Privilege::class, 'privilege_id', 'id');
    }
}
