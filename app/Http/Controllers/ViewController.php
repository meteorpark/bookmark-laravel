<?php

namespace App\Http\Controllers;

/**
 * Class ViewController
 * @package App\Http\Controllers
 */
class ViewController extends Controller
{

    /**
     * @OA\Get(
     *      path="/api/terms",
     *      tags={"WebView"},
     *      summary="이용약관",
     *      description="이용약관 웹뷰",
     *      operationId="index",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=404, description="not found page"),
     * )
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function terms()
    {
        return view('terms');
    }

    /**
     * @OA\Get(
     *      path="/api/privacy",
     *      tags={"WebView"},
     *      summary="개인정보보호",
     *      description="개인정보 웹뷰",
     *      operationId="index",
     *      @OA\Response(response=200, description="successful operation"),
     *      @OA\Response(response=404, description="not found page"),
     * )
     */
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function privacy()
    {
        return view('privacy');
    }
}
