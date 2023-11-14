<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;

class BlogController extends Controller
{
    /**
     * Вывод информации о хештеге и постам в данной категории
     *
     * @param $id
     * @return Factory|View
     */
    public function category(int $id)
    {
        $category = Category::where('id', $id)->first();

        return view('blog.category', [
            'category'   => $category,
            'posts'      => $category->posts()->where('published', 1)->paginate(10),
            'categories' => Category::all(),
        ]);
    }

    /**
     * Выводит информацию по посту
     *
     * @param $id
     * @return Factory|View
     */
    public function post(int $id)
    {
        return view('blog.post', [
            'post'       => $post = Post::find($id),
            'categories' => Category::all(),
            'author'     => $post->getAuthor(),
        ]);
    }

    
}
