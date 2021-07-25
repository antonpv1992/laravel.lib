<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->realText(rand(10,40)),
            'description' => $this->faker->realText(rand(100, 300)),
            'author' => $this->faker->name,
            'image' => '/images/book.jpg',
            'genre' => $this->faker->randomElement(['Fantasy', 'Mystery', 'Thriller', 'Historical fiction', 'Science fiction', 'Detective fiction', 'Adventure', 'Classic']),
            'year' => rand(1700, 2021),
            'country' => $this->faker->country,
            'pages' => rand(10,3000),
            'book' => $this->faker->realText(rand(1000, 5000)),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [

            ];
        });
    }
}
