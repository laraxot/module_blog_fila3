<?php

declare(strict_types=1);

namespace Modules\Blog\Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use Modules\Blog\Models\Comment;

class CommentFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = Comment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {


        return [
            'comment' => $this->faker->text,
            'post_id' => $this->faker->integer,
            'user_id' => $this->faker->integer,
            'parent_id' => $this->faker->integer
        ];
    }
}
