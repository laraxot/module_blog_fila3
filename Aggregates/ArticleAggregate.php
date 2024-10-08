<?php

declare(strict_types=1);
/**
 * @see https://github.com/cnastasi/event-sourcing-with-laravel/blob/main/app/Aggregates/ProductAggregate.php
 */

namespace Modules\Blog\Aggregates;

use Carbon\Carbon;
use Modules\Blog\Datas\RatingArticleData;
use Modules\Blog\Datas\RatingArticleWinnerData;
use Modules\Blog\Error\NullArticleError;
use Modules\Blog\Error\RatingClosedArticleError;
use Modules\Blog\Events\Article\CloseArticle;
use Modules\Blog\Events\RatingArticle;
use Modules\Blog\Events\RatingArticleWinner;
use Modules\Blog\Events\RatingClosedArticle;
use Modules\Blog\Models\Article;
use Modules\Blog\Models\Profile;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class ArticleAggregate extends AggregateRoot
{
    public function winner(RatingArticleWinnerData $command): self
    {
        $article = Article::firstWhere(['id' => $command->articleId]);

        if (null === $article) {
            throw new NullArticleError(articleId: $command->articleId);
        }

        if (Carbon::now() <= $article->closed_at) {
            throw new \Exception('bets ended on ['.$article->closed_at.']');
        }

        if (null !== $article->rewarded_at) {
            throw new \Exception('just assign winners on ['.$article->rewarded_at.']');
        }

        $event = new RatingArticleWinner(
            ratingId: $command->ratingId,
            articleId: $command->articleId
        );
        $this->recordThat($event);

        // $this->recordThat(
        //     new CloseArticle(
        //         articleId: $event->articleId
        //     )
        // );

        $this->persist();

        return $this;
    }

    public function rating(RatingArticleData $command): static
    {
        $profile = Profile::firstOrCreate(['user_id' => $command->userId], ['credits' => 1000]);
        $profile->update(['credits' => 1000]);
        if ($profile->credits - $command->credit < 0) {
            throw new \Exception('there are not enough credits Your credits ['.$profile->credits.']');
        }

        $article = Article::firstWhere(['id' => $command->articleId]);
        if (null === $article) {
            throw new NullArticleError(articleId: $command->articleId);
        }

        if (Carbon::now() >= $article->closed_at) {
            throw new \Exception('bets ended on ['.$article->closed_at.']');
        }

        // if ($article->closed_at > Carbon::now()) {
        $event = new RatingArticle(
            userId: $command->userId,
            articleId: $command->articleId,
            ratingId: $command->ratingId,
            credit: $command->credit);

        $this->recordThat($event);
        // } else {
        // dddx('l\'utente ha scommesso su articolo chiuso');
        //    $this->recordThat(
        //        new RatingClosedArticle(
        //            articleId: $command->articleId,
        //            userId: $command->userId,
        //            ratingId: $command->ratingId,
        //            credit: $command->credit
        //        ));

        //    throw new RatingClosedArticleError(articleId: $command->articleId, userId: $command->userId, ratingId: $command->ratingId, credit: $command->credit);
        // }

        $this->persist();

        return $this;
    }
}
