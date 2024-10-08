<?php

declare(strict_types=1);

namespace Modules\Blog\Datas;

use Spatie\LaravelData\Data;

class RatingArticleWinnerData extends Data
{
    public string $ratingId;

    public string $articleId;
}
