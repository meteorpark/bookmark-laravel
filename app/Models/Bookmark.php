<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

/**
 * Class Bookmark
 * @package App\Models
 */
class Bookmark extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];


    /**
     * @param $value
     * @return Carbon
     */
    public function getCreatedAtAttribute($value): Carbon
    {
        return Carbon::parse($value)->timezone(Config::get('app.timezone'));
    }

}
