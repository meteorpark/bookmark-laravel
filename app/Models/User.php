<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;


/**
 * @OA\Schema(required={"join_type", "sns_id", "profile_image", "name"}, @OA\Xml(name="User"))
 *
 * Class User
 * @package App\Models
 */
class User extends Model implements JWTSubject
{

    /**
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'id', 'updated_at', 'sns_id',
    ];


    /**
     * @OA\Property(enum={"kakao", "facebook", "google"})
     * @var string
     */
    private $join_type;
    /**
     * @OA\Property()
     * @var string
     */
    private $sns_id;
    /**
     * @OA\Property()
     * @var string
     */
    private $profile_image;
    /**
     * @OA\Property()
     * @var string
     */
    private $name;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
