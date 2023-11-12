<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class PostsController extends Controller
{
    public function Posts()
    {
        $posts = new Posts();

        return view('blog.posts', [
            'posts'      => $posts->where('published', 1)->orderBy('created_at', 'desc')->paginate(10),
            'categories' => Category::all(),
        ]);
    }
    
}
