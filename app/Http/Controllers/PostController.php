<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Services\PostService;
use Illuminate\Contracts\View\View;

class PostController extends Controller
{
    /**
     * @param PostService $postService
     * @return View
     */
    public function index(PostService $postService): View
    {
        $sort = request('sort','desc');
        $data = $postService->allPosts($sort);
        return view('home', ['posts' => $data['posts'], 'sort' => $data['sort']]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StorePostRequest $request
     * @param PostService $postService
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePostRequest $request, PostService $postService): \Illuminate\Http\RedirectResponse
    {
        if ($postService->store($request)) {
            return redirect()->back()->with('success', 'Post created successfully');
        }

        return redirect()->back()->with('success', 'Something went wrong');
    }
}
