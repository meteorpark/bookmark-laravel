<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


/**
 * @OA\Schema(required={"join_type", "sns_id", "profile_image", "name"}, @OA\Xml(name="User"))
 *
 * Class User
 * @package App\Models
 */
class User extends Model
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
}
