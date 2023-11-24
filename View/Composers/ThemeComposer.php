<?php

declare(strict_types=1);

namespace Modules\Blog\View\Composers;

use Modules\Blog\Models\Post;
use Illuminate\Support\Carbon;
use Modules\Blog\Models\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Auth\Authenticatable;

class ThemeComposer
{
    /**
     * Undocumented function.
     *
     * @return Collection<int, Post>
     */
    public function getPosts()
    {
        return Post::get();
    }

    /**
     * @return Post|null
     */
    public function latestPost(){
         // Latest post
     $latestPost = Post::where('active', '=', 1)
     ->whereDate('published_at', '<', Carbon::now())
     ->orderBy('published_at', 'desc')
     ->limit(1)
     ->first();

     return $latestPost;
    }



/**
 * Show the most popular 3 posts based on upvotes
 *
 * @return Collection<int, Post>
 */
 public function popularPosts(){
 $popularPosts = Post::query()
     ->leftJoin('upvote_downvotes', 'posts.id', '=', 'upvote_downvotes.post_id')
     ->select('posts.*', DB::raw('COUNT(upvote_downvotes.id) as upvote_count'))
     ->where(function ($query) {
         $query->whereNull('upvote_downvotes.is_upvote')
             ->orWhere('upvote_downvotes.is_upvote', '=', 1);
     })
     ->where('active', '=', 1)
     ->whereDate('published_at', '<', Carbon::now())
     ->orderByDesc('upvote_count')
     ->groupBy([
         'posts.id',
         'posts.title',
         'posts.slug',
         'posts.thumbnail',
         'posts.body',
         'posts.active',
         'posts.published_at',
         'posts.user_id',
         'posts.created_at',
         'posts.updated_at',
         'posts.meta_title',
         'posts.meta_description',
     ])
     ->limit(5)
     ->get();
     return $popularPosts;
 }

/**
 * @return Collection<int, Post>
 */
 public function recommendedPosts(){
 $user = auth()->user();

        if ($user instanceof Authenticatable) {
            $leftJoin = '(SELECT cp.category_id, cp.post_id FROM upvote_downvotes
                        JOIN category_post cp ON upvote_downvotes.post_id = cp.post_id
                        WHERE upvote_downvotes.is_upvote = 1 and upvote_downvotes.user_id = ?) as t';
            $recommendedPosts = Post::query()
                ->leftJoin('category_post as cp', 'posts.id', '=', 'cp.post_id')
                ->leftJoin(DB::raw($leftJoin), function ($join) {
                    $join->on('t.category_id', '=', 'cp.category_id')
                        ->on('t.post_id', '<>', 'cp.post_id');
                })
                ->select('posts.*')
                ->where('posts.id', '<>', DB::raw('t.post_id'))
                ->setBindings([$user->id])
                ->limit(3)
                ->get();
        } // Not authorized - Popular posts based on views
        else {
            $recommendedPosts = Post::query()
                ->leftJoin('post_views', 'posts.id', '=', 'post_views.post_id')
                ->select('posts.*', DB::raw('COUNT(post_views.id) as view_count'))
                ->where('active', '=', 1)
                ->whereDate('published_at', '<', Carbon::now())
                ->orderByDesc('view_count')
                ->groupBy([
                    'posts.id',
                    'posts.title',
                    'posts.slug',
                    'posts.thumbnail',
                    'posts.body',
                    'posts.active',
                    'posts.published_at',
                    'posts.user_id',
                    'posts.created_at',
                    'posts.updated_at',
                    'posts.meta_title',
                    'posts.meta_description',
                ])
                ->limit(3)
                ->get();
        }
        return $recommendedPosts;
    }


    /**
     * Show recent categories with their latest posts
     *
     * @return Collection<int, Category>
     */
    public function categories(){
    $categories = Category::query()
    //            ->with(['posts' => function ($query) {
    //                $query->orderByDesc('published_at');
    //            }])
                ->whereHas('posts', function ($query) {
                    $query
                        ->where('active', '=', 1)
                        ->whereDate('published_at', '<', Carbon::now());
                })
                ->select('categories.*')
                ->selectRaw('MAX(posts.published_at) as max_date')
                ->leftJoin('category_post', 'categories.id', '=', 'category_post.category_id')
                ->leftJoin('posts', 'posts.id', '=', 'category_post.post_id')
                ->orderByDesc('max_date')
                ->groupBy([
                    'categories.id',
                    'categories.title',
                    'categories.slug',
                    'categories.created_at',
                    'categories.updated_at',
                ])
                ->limit(5)
                ->get();
                return $categories;
}


}
