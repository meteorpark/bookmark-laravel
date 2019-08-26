<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookmarkCategory extends Model
{
    protected $guarded = ['id'];

    protected $hidden = ['user_id', 'created_at', 'updated_at'];

    protected $casts = [
        'id' => 'string',
        'rank' => 'string',
    ];
}
