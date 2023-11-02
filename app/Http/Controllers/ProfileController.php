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
        $sort = request('sort','desc');
        $data = $postService->allUserPosts($sort);
        return view('profile.index', ['posts' => $data['posts'], 'sort' => $data['sort']]);
    }
}
