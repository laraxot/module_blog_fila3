<?php

declare(strict_types=1);

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Builder as EloquentBuilder;

/**
 * Modules\Blog\Models\EloquentModel.
 *
 * @method static EloquentBuilder|EloquentModel newModelQuery()
 * @method static EloquentBuilder|EloquentModel newQuery()
 * @method static EloquentBuilder|EloquentModel query()
 *
 * @mixin \Eloquent
 */
class EloquentModel extends BaseModel
{

}
