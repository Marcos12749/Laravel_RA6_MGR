<?php

namespace Database\Factories;

use App\Models\UserMGR;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PostMGR>
 */
class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var class-string<\Illuminate\Database\Eloquent\Model>
     */
    protected $model = \App\Models\PostMGR::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $isPublished = fake()->boolean(70); // 70% publicados
        
        return [
            'user_id' => UserMGR::factory(),
            'title' => fake()->sentence(6),
            'content' => fake()->paragraphs(5, true),
            'excerpt' => fake()->text(200),
            'views' => fake()->numberBetween(0, 10000),
            'category' => fake()->randomElement([
                'Tecnología',
                'Ciencia',
                'Deportes',
                'Entretenimiento',
                'Negocios',
                'Salud',
                'Educación',
                'Viajes',
                'Cultura',
                'Política'
            ]),
            'published_at' => $isPublished ? fake()->dateTimeBetween('-1 year', 'now') : null,
            'is_published' => $isPublished,
        ];
    }

    /**
     * Indicate that the post should be published.
     */
    public function published(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => true,
            'published_at' => fake()->dateTimeBetween('-1 year', 'now'),
        ]);
    }

    /**
     * Indicate that the post should be unpublished.
     */
    public function unpublished(): static
    {
        return $this->state(fn (array $attributes) => [
            'is_published' => false,
            'published_at' => null,
        ]);
    }

    /**
     * Indicate that the post should be popular (many views).
     */
    public function popular(): static
    {
        return $this->state(fn (array $attributes) => [
            'views' => fake()->numberBetween(5000, 50000),
        ]);
    }
}
