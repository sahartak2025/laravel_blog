<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Contracts\View\View;

class ProfileController extends Controller
{
    /**
     * @param PostService $postService
     * @return View
     */
    public function index(PostService $postService): View
    {
        $data = $postService->allUserPosts();
        return view('profile.index', ['posts' => $data['posts'], 'sort' => $data['sort']]);
    }
}
