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
     * @OA\Post(
     *      path="/api/v1/bookmarks",
     *      tags={"Bookmark"},
     *      summary="북마크 생성",
     *      description="북마크 생성",
     *      operationId="store",
     *      @OA\RequestBody(
     *          description="",
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(ref="#/components/schemas/BookmarkCreate"))
     *      ),
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=400, description="bad request"),
     *      @OA\Response(response=401, description="unauthorized token"),
     *      @OA\Response(response=409, description="unknown user"),
     * )
     */

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
