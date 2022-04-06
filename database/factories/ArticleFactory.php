<?php

namespace Database\Factories;

use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class ArticleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->sentence(mt_rand(2,8)),
            'content' => collect($this->faker->paragraphs(mt_rand(5,10)))
                    ->map(fn($p) =>"<p>$p</p>")
                    ->implode(''),
            'user_id' => mt_rand(1,4),
            'category_id' => mt_rand(1,3)
        ];
    }
}
