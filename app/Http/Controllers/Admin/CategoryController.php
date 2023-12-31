<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class CategoryController extends Controller
{
    /**
     * Страница отображения информации о хештегах
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        return view('admin.categories.index', [
            'categories' => Category::paginate(10),
        ]);
    }

    /**
     * Страница создания новой хештега
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Принимает данные из формы создания новой хештега, создает категорию и редиректит на страницу со списком
     * категорий
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        Category::create($this->validate($request, [
            'title'     => 'required|unique:categories|max:30',
            'published' => 'boolean',
        ], [
            'required' => 'Поле :attribute не заполнено',
            'unique'   => 'Поле :attribute не уникально',
            'max'      => 'Поле :attribute не может быть длиннее 30 символов',
        ]));

        return redirect()->route('admin.category.index')->with('status', 'Хештег успешно создан!');
    }

    /**
     * Страница редактирования хештега
     *
     * @param Category $category
     * @return Factory|\Illuminate\View\View
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', [
            'category' => $category,
        ]);
    }

    /**
     * Изменяет данные о хештега и редиректит обратно на страницу редактирования этой хештега
     *
     * @param Request $request
     * @param Category $category
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $category->update($this->validate($request, [
            'title'     => 'required|unique:categories|max:30',
            'published' => 'boolean',
        ], [
            'required' => 'Поле :attribute не заполнено',
            'unique'   => 'Поле :attribute не уникально',
            'max'      => 'Поле :attribute не может быть длиннее 30 символов',
        ]));

        return redirect()->route('admin.category.edit', $category)->with('status', 'Хештег успешно обновлен!');
    }

    /**
     * Удаление хештега
     *
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('status', 'Хештег успешно удален');
    }
}
