<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Bookmark extends Model
{
    protected $guarded = ['id'];


    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->timezone(Config::get('app.timezone'));
    }

}
