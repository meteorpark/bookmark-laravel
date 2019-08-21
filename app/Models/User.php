<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
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


    /**
     * @var array
     */
    protected $hidden = [
        'id',
    ];


    public function getProfileImageAttribute($value)
    {

        return $value ?? "hihihihi";
//        $this->attributes['profile_image'] = "Ddd";

    }

}
