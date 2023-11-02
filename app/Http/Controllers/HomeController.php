<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * @param PostService $postService
     * @return View
     */
    public function index(PostService $postService): View
    {
        $data = $postService->allPosts();
        return view('home', ['posts' => $data['posts'], 'sort' => $data['sort']]);
    }
}
