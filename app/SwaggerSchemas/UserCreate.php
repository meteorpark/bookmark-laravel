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
