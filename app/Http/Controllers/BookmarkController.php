<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBookmarkRequest;
use App\Http\Resources\BookmarkCollection;
use App\Jobs\ProcessBookmark;
use App\Models\Bookmark;


class BookmarkController extends Controller
{

    /**
     * BookmarkController constructor.
     */
    public function __construct()
    {
    }




    /**
     * @param storeBookmarkRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
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


    /**
     * @return BookmarkCollection
     */
    public function index()
    {
        return new BookmarkCollection(Bookmark::paginate());
    }
}
