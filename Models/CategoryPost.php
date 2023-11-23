<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Blog\Models\CategoryPost
 *
 * @property int $id
 * @property int $category_id
 * @property int $post_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost query()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost wherePostId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CategoryPost extends EloquentModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $connection = 'blog';

    protected $table = 'category_post';
}
