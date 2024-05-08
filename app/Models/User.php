<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\CustomSendresetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Notifications\Notifiable;


/**
 * @OA\Schema(
 *     type="object",
 *     title="User",
 * )
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'phone',
        'email',
        'email_verified_at',
        'phone_verified_at',
        'password',
        'remember_token',
        'refresh_token',
        'user_type_id',
        'deleted',
        'deleted_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'user_type_id',
        'refresh_token',
        'email_verified_at',
        'phone_verified_at',
        'created_at',
        'updated_at',
    ];

    /**
     * @OA\Property(
     *     property="id",
     *     description="User's id",
     *     type="integer",
     * )
     */
    public function getIdAttribute()
    {
        return $this->attributes['id'];
    }

    /**
     * @OA\Property(
     *     property="first_name",
     *     description="User's first_name",
     *     type="string",
     * )
     */

    public $first_name;

    /**
     * @OA\Property(
     *     property="last_name",
     *     description="User's last_name",
     *     type="string",
     * )
     */

    public $last_name;


    /**
     * @OA\Property(
     *     property="phone",
     *     description="User's phone",
     *     type="string",
     * )
     */

    public $phone;

    /**
     * @OA\Property(
     *     property="email",
     *     description="User's email",
     *     type="string",
     * )
     */

    public function getEmailAttribute()
    {
        return $this->attributes['email'];
    }

    /**
     * @OA\Property(
     *     property="user_type",
     *     description="UserType Model",
     *     type="Object",
     *     ref="#/components/schemas/UserType"
     * )
     */
    public function user_type(): BelongsTo
    {
        return $this->belongsTo(UserType::class, 'user_type_id', 'id');
    }




    /**
     * @OA\Property(
     *     property="roles",
     *     description="Array of Role Model",
     *     type="array",
     *     @OA\Items(ref="#/components/schemas/Role")
     * )
     */
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'user_id', 'role_id')->where('deleted', NULL);
    }

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function hasPrivilige($privilige)
    {
        return $this->roles->pluck('privileges')->flatten()->pluck('name')->contains($privilige);
    }
}
