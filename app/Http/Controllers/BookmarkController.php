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
     * @OA\GET(
     *     path="/api/v1/bookmark",
     *    tags={"북마크"},
     *   summary="내가 북마크한 내용을 조회",
     *  operationId="login",
     *      @OA\Response(
     *         response=401,
     *        description="Unauthorized"
     *   ),
     *          @OA\Response(
     *              response=400,
     *              description="Invalid request"
     *         ),
     *        @OA\Response(
     *           response=404,
     *          description="not found"
     *     ),
     *)
     */

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
