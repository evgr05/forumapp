<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Category
 *
 * @property int $id
 * @property string $title
 * @property int $published
 * @property-read Collection|Post[] $posts
 * @method static Builder|Category lastCategories($count)
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static Builder|Category query()
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category wherePublished($value)
 * @method static Builder|Category whereTitle($value)
 * @mixin Eloquent
 */
class Category extends Model
{
    /**
     * Атрибуты, доступные для назначения
     * Альтернативный короткий вариант: protected $guarded = []
     *
     * @var array
     */
    protected $fillable = ['title', 'published'];

    /**
     * Отключаем метки времени - updated_at, created_at
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Возвращает посты, связанные с категорией
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany('App\Models\Post');
    }

    /**
     * Возвращает $count последних добавленных категорий
     *
     * @param $query
     * @param $count
     * @return mixed
     */
    public function scopeLastCategories($query, $count)
    {
        return $query->orderBy('id', 'desc')->take($count)->get();
    }
}
