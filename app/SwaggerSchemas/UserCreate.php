<?php


/**
 * @OA\Schema(required={"join_type", "sns_id", "profile_image", "name"}, @OA\Xml(name="UserCreate"))
 */
class UserCreate
{

    /**
     * @OA\Property(enum={"kakao", "facebook", "google"})
     * @var string
     */
    public $join_type;
    /**
     * @OA\Property()
     * @var string
     */
    public $sns_id;
    /**
     * @OA\Property()
     * @var string
     */
    public $profile_image;
    /**
     * @OA\Property()
     * @var string
     */
    public $name;

}
