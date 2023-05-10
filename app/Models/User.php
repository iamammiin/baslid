<?php

namespace App\Models;

use App\Constant\ProductStatistic\ProductStatisticDatabaseField;
use App\Constant\User\UserDatabaseField;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @OA\Schema(
 *      schema="UserDTO",
 *      title="User Dto",
 *      description="User data",
 *      type="object",
 *      @OA\Property(property="firstName", title="firstName", description="first name of user", type="string", example="Amin"),
 *      @OA\Property(property="lastName", title="lastName", description="last name of user", type="string", example="Mazreali"),
 *      @OA\Property(property="phone", title="phone", description="phone of user", type="string", example="09214125578"),
 *      @OA\Property(property="type", title="type", description="type of user", type="int", example=2),
 *      @OA\Property(property="email", title="email", description="email of user", type="string", example="amin@gmail.com"),
 *      @OA\Property(property="country", title="country", description="country of user", type="string", example="iran"),
 *      @OA\Property(property="id", title="id", description="id of user", type="int", example=1),
 *      @OA\Property(property="address", title="address", description="address of user", type="string", example="Iran, Test"),
 *      @OA\Property(property="avatar", title="avatar", description="avatar of user", type="string", example="test.png"),
 *      @OA\Property(property="language", title="language", description="language of user", type="string", example="Persian"),
 *      @OA\Property(property="price", title="price", description="price of user", type="string", example="Euro"),
 *      @OA\Property(property="biography", title="biography", description="biography of user", type="string", example="test, test"),
 *      @OA\Property(property="paypalAddress", title="paypalAddress", description="paypal address of user", type="string", example="paypal.com"),
 *      @OA\Property(property="token", title="token", description="token of user", type="string", example="jwt token"),
 *      @OA\Property(property="discountCode", title="discountCode", description="discount code of user", type="string", example="1231241"),
 *      @OA\Property(property="discountPercent", title="discountPercent", description="discount percent of user", type="int", example=10),
 * )
 */
class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = UserDatabaseField::AVAILABLE_FOR_CREATE_OR_UPDATE;

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier(): mixed
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims(): array
    {
        return [];
    }

    public function productStatistic(): HasMany
    {
        return $this->hasMany(ProductStatistic::class, ProductStatisticDatabaseField::USER_ID, 'id');
    }
}
