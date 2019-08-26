<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBookmarkRequest;
use App\Http\Resources\BookmarkCollection;
use App\Jobs\ProcessBookmark;
use App\Models\Bookmark;
use App\Services\BookmarkServiceInterface;


class BookmarkController extends Controller
{

    public $bookmarkService;

    /**
     * BookmarkController constructor.
     * @param BookmarkServiceInterface $bookmarkService
     */
    public function __construct(BookmarkServiceInterface $bookmarkService)
    {
        $this->middleware('auth:api', ['except' => ['']]);
        $this->bookmarkService = $bookmarkService;
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
