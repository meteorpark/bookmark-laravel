<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BookmarkCategory
 * @package App\Models
 */
class BookmarkCategory extends Model
{
    /**
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * @var array
     */
    protected $hidden = ['user_id', 'created_at', 'updated_at'];

    /**
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'rank' => 'string',
    ];


    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function bookmarks()
    {
        return $this->hasMany(Bookmark::class, 'category_id')->where('user_id', auth()->user()->id);
    }
}
