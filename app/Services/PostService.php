<?php


namespace App\Services;


use App\Models\Post;
use App\Models\User;

class PostService
{
    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $user = $request->user();
        $formData = $request->all();
        return $user->posts()->create($formData);
    }

    public function storeApiPosts($posts)
    {
        $user = User::getAdminUser();
        if (!$user) {
            return false;
        }
        foreach ($posts as $post) {
            $array = [
                'title' => $post['title'],
                'description' => $post['description'],
                'created_at' => $post['publishedAt']
            ];
            $user->posts()->create($array);
        }
        return true;
    }

    /**
     * @return array
     */
    public function allPosts(): array
    {
        $sort = request('sort','desc');
        $posts = Post::orderBy('created_at', $sort)->paginate(10);
        $sort = $sort == 'desc' ? 'asc' : 'desc';

        return [
            'posts' => $posts,
            'sort' => $sort,
        ];
    }

    /**
     * @return array
     */
    public function allUserPosts(): array
    {
        $sort = request('sort','desc');
        $posts = Post::where('user_id', '=', auth()->id())->orderBy('created_at', $sort)->paginate(10);
        $sort = $sort == 'desc' ? 'asc' : 'desc';

        return [
            'posts' => $posts,
            'sort' => $sort,
        ];
    }
}
