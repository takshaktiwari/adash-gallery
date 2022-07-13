<?php

namespace Database\Factories;

use App\Models\User;
use Takshak\Agallery\Models\Gallery;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Gallery>
 */
class GalleryFactory extends Factory
{
    protected $model = Gallery::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = $this->faker->realText(rand(15, 60), 2);
        return [
            'name'          =>  $name,
            'description'   =>  $this->faker->realText(rand(150, 250), 2),
            'slug'          =>  Str::of($name)->slug('-')->append(time()),
            'status'        =>  rand(0, 1),
            'featured'      =>  rand(0, 1),
            'image_lg'      =>  null,
            'image_md'      =>  null,
            'image_sm'      =>  null,
            'item_img_width'    =>  rand(8, 12) * 100,
            'item_img_height'   =>  rand(6, 12) * 100,
            'user_id'           =>  User::inRandomOrder()->first()?->id,
        ];
    }
}
