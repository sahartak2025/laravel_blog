<?php

namespace App\Console\Commands;

use App\Services\PostService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class Posts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync-posts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Receives posts from the API and stores them in the database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $response = Http::get('https://candidate-test.sq1.io/api.php');
        $arrayData = json_decode($response->body(), true);

        if (isset($arrayData['status']) && $arrayData['status'] === 'ok') {
            $posts = $arrayData['articles'];
            (new PostService())->storeApiPosts($posts);
        }

        return true;
    }
}
