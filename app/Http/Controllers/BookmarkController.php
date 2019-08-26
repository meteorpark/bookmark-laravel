<?php

namespace App\Http\Controllers;

use App\Http\Requests\storeBookmarkRequest;
use App\Http\Resources\BookmarkCollection;
use App\Jobs\ProcessBookmark;
use App\Models\Bookmark;
use App\Services\BookmarkServiceInterface;


/**
 * Class BookmarkController
 * @package App\Http\Controllers
 */
class BookmarkController extends Controller
{

    /**
     * @var BookmarkServiceInterface
     */
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

        $data = array_merge($request->all(), ['user_id' => auth()->user()->id]);
        $bookmark = $this->bookmarkService->bookmark($data);

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
