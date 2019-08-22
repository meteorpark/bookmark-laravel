<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBookmarkRequest;
use App\Http\Resources\BookmarkCollection;
use App\Jobs\ProcessBookmark;
use App\Models\Bookmark;

/**
 * Class BookmarkController
 * @package App\Http\Controllers
 */
class BookmarkController extends Controller
{

    /**
     * BookmarkController constructor.
     */
    public function __construct()
    {
    }


    public function store(storeBookmarkRequest $request)
    {

        $bookmark = Bookmark::create([
            'user_id' => $request->user_id,
            'category_id' => $request->category_id,
            'url' => $request->url,
        ]);

        ProcessBookmark::dispatch($bookmark);

        return response()->json(null, 200);
    }


    public function index()
    {
        return new BookmarkCollection(Bookmark::paginate());
    }
}
