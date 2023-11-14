<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Modules\Blog\Models\PostTranslation
 *
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PostTranslation query()
 * @mixin \Eloquent
 */
class PostTranslation extends Model
{
    public $timestamps = false;

    protected $fillable = ['title', 'content'];
}
