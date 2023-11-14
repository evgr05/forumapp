<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Posts;
use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class PostController extends Controller
{
    /**
     * Страница отображения информации о постах
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.posts.index', [
            'posts' => Post::orderBy('created_at', 'desc')->paginate(10),
        ]);
    }

    /**
     * Страница с формой создания нового поста
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.posts.create', [
            'categories' => Category::where('published', 1)->get(),
        ]);
    }

    /**
     * Принимает post запрос созданного поста, сохраняет его в базу и переадресовывает на страницу со всеми постами
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $this->validate($request, [
            'title'       => 'required|max:255',
            'desc'        => 'required',
            'published'   => 'boolean',
            'category_id' => 'required|exists:categories,id',
        ], [
            'required' => 'Поле :attribute не заполнено',
            'unique'   => 'Поле :attribute не уникально',
            'max'      => 'Поле :attribute не может быть длиннее 255 символов',
            'exists'   => 'Вы указали некорректное поле хештега',
        ]);

        $data['created_by'] = Auth::id();
        $data['updated_at'] = Auth::id();

        Post::create($data);

        return redirect()->route('admin.post.index')->with('status', 'Пост успешно создан!');
    }

    /**
     * Страница редактирования поста
     *
     * @param Post $post
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', [
            'post'       => $post,
            'categories' => Category::where('published', 1)->get(),
        ]);
    }

    /**
     * Принимает post-данные на обновление поста, обновляет его и переадресовывает на страницу со списком всех постов
     *
     * @param Request $request
     * @param Post $post
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Post $post): RedirectResponse
    {
        $data = $this->validate($request, [
            'title'       => 'required|max:255',
            'desc'        => 'required',
            'published'   => 'boolean',
            'category_id' => 'required|exists:categories,id',
        ], [
            'required' => 'Поле :attribute не заполнено',
            'unique'   => 'Поле :attribute не уникально',
            'max'      => 'Поле :attribute не может быть длиннее 255 символов',
            'exists'   => 'Вы указали некорректное поле хештега',
        ]);

        $data['created_by'] = $post->created_by;
        $data['edit_by'] = Auth::id();

        $post->update($data);

        return redirect()->route('admin.post.index')->with('status', 'Пост успешно обновлен!');
    }

    /**
     * Удаляет пост
     *
     * @param Post $post
     * @return RedirectResponse
     */
    public function destroy(Post $post): RedirectResponse
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }
}
