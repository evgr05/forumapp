<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Post
 *
 * @property int $id
 * @property string $title
 * @property int $category_id
 * @property string|null $desc_short
 * @property string $desc
 * @property int|null $published
 * @property int $view
 * @property int $created_by
 * @property int|null $edit_by
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Post lastPosts($count)
 * @method static Builder|Post newModelQuery()
 * @method static Builder|Post newQuery()
 * @method static Builder|Post published()
 * @method static Builder|Post query()
 * @method static Builder|Post whereCategoryId($value)
 * @method static Builder|Post whereCreatedAt($value)
 * @method static Builder|Post whereCreatedBy($value)
 * @method static Builder|Post whereDesc($value)
 * @method static Builder|Post whereDescShort($value)
 * @method static Builder|Post whereEditBy($value)
 * @method static Builder|Post whereId($value)
 * @method static Builder|Post whereMetaDesc($value)
 * @method static Builder|Post whereMetaKey($value)
 * @method static Builder|Post whereMetaTitle($value)
 * @method static Builder|Post wherePublished($value)
 * @method static Builder|Post whereTitle($value)
 * @method static Builder|Post whereUpdatedAt($value)
 * @method static Builder|Post whereView($value)
 * @mixin Eloquent
 */
class Post extends Model
{
    /**
     * Атрибуты, доступные для назначения
     *
     * @var array
     */
    protected $fillable = [
        'title', 'category_id', 'desc_short', 'desc', 'published', 'created_by', 'edit_by'
    ];

    /**
     * Scope - отображать только опубликованные посты
     *
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }

    /**
     * Scope - сортировка по дате, с конца, и только последние $count записей
     *
     * @param $query
     * @param $count
     * @return mixed
     */
    public function scopeLastPosts($query, $count)
    {
        return $query->orderBy('created_at', 'desc')->take($count)->get();
    }

    /**
     * Возвращает название категории, по значению category_id у поста
     *
     * @param int $id
     * @return mixed
     */
    public function category(int $id)
    {
        return Category::find($id);
    }

    public function getAuthor(): User
    {
        return User::find($this->created_by);
    }
}
