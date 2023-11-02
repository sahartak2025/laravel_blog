<?php

namespace Tests\Unit\Post;

use App\Models\User;
use App\Services\PostService;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_post_create()
    {
        User::factory()->create([
            'email' => 'example@user.com',
            'password' => bcrypt('password123'),
        ]);

        $this->post(route('user.login'), [
            'email' => 'example@user.com',
            'password' => 'password123',
        ]);

        $postData = [
            'title' => 'Post title',
            'description' => 'Post description',
        ];

        $response = $this->post(route('post.create'), $postData);

        $response->assertStatus(302);
        $this->assertDatabaseHas('posts', $postData);
    }

    public function test_post_create_from_api()
    {
        (new UserSeeder())->run();

        $postData = [
            [
                'title' => 'Post title',
                'description' => 'Post description',
                'publishedAt' => '2022-08-31T10:51:55Z',
            ],
            [
                'title' => 'Post title 2',
                'description' => 'Post description 2',
                'publishedAt' => '2022-08-31T10:51:55Z',
            ],
        ];

        $postService = new PostService();
        $postService->storeApiPosts($postData);

        foreach ($postData as $post) {
            $this->assertDatabaseHas('posts', ['title' => $post['title']]);
        }
    }
}
