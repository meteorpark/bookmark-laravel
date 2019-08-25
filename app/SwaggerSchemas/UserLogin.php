<?php


/**
 * @OA\Schema(required={"sns_id", "join_type"}, @OA\Xml(name="UserCreate"))
 */
class UserLogin
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
}
