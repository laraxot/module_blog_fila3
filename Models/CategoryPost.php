<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * Modules\Blog\Models\CategoryPost
 *
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|CategoryPost query()
 * @mixin \Eloquent
 */
class CategoryPost extends EloquentModel
{
    use HasFactory;

    /**
     * @var string
     */
    protected $connection = 'blog';

    protected $table = 'category_posts';
}
