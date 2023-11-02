<?php


namespace App\Services;


use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class PostService
{
    /**
     * @param $request
     * @return mixed
     */
    public function store($request)
    {
        $post = new Post(['user_id' => Auth::id()]);
        return $post->fill($request->all())->save();
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
    public function allPosts(string $sort): array
    {
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
    public function allUserPosts(string $sort): array
    {
        $posts = Auth::user()->posts()->orderBy('created_at', $sort)->paginate(10);
        $sort = $sort == 'desc' ? 'asc' : 'desc';

        return [
            'posts' => $posts,
            'sort' => $sort,
        ];
    }
}
