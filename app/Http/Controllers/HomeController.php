<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Главная страница
     *
     * @return Application|Factory|\Illuminate\Contracts\View\View|View
     */
    public function index()
    {
        $post = new Post();

        return view('home', [
            'posts'      => $post->where('published', 1)->orderBy('created_at', 'desc')->paginate(10),
            'categories' => Category::all(),
        ]);
    }
}
