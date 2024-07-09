<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // dd(1);
        // Retrieve all posts
        $posts = Post::all();

        // Return posts as a JSON response
        return response()->json($posts);
    }
}
