<?php

namespace Database\Factories;

use Takshak\Agallery\Models\Gallery;
use Takshak\Agallery\Models\GalleryItem;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GalleryItem>
 */
class GalleryItemFactory extends Factory
{
    protected $model = GalleryItem::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $item_type = $this->getItemType();
        $youtube_url = ($item_type == 'video') ? 'https://www.youtube.com/watch?v=t0Q2otsqC4I' : null;
        return [
            'title'         =>  $this->faker->realText(rand(20, 50), 2),
            'description'   =>  $this->faker->realText(rand(150, 250), 2),
            'item_type'     =>  $item_type,
            'image_lg'      =>  null,
            'image_md'      =>  null,
            'image_sm'      =>  null,
            'youtube_url'   =>  $youtube_url,
            'status'        =>  rand(0, 1),
            'user_id'       =>  User::inRandomOrder()->first()->id,
        ];
    }

    public function getItemType()
    {
        $arr = ['image', 'video'];
        shuffle($arr);
        return end($arr);
    }
}
