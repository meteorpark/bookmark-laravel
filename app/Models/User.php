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
}
