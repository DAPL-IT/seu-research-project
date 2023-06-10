<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RentType;
use App\Models\Area;
use App\Models\SurfaceUser;
use App\Models\User;
use App\Models\RentAd;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RentAd>
 */
class RentAdFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $rentType = RentType::inRandomOrder()->first();
        $area   = Area::inRandomOrder()->first()->id;
        $poster = SurfaceUser::inRandomOrder()->first()->id;
        $moderator = User::where('role', 'moderator')->where('locked', 0)->inRandomOrder()->first()->id;

        return [
            'title' => fake()->text(150),
            'price' => mt_rand(3000, 50000),
            'rooms' => $rooms = mt_rand(1, 10),
            'bathrooms' => mt_rand(1, ceil($rooms/2)),
            'floor' => mt_rand(1, 20),
            'image' => RentAd::IMAGE_DIR.'demo.jpg',
            'description' =>  'Lorem ipsum dolor sit amet consectetur adipisicing elit. Non, consequatur. Harum aliquid temporibus fugit laudantium quis reprehenderit fugiat repellendus? Quia ipsam suscipit voluptatem temporibus cupiditate cumque provident autem nisi dignissimos hic odit ratione itaque necessitatibus doloremque, eveniet aspernatur placeat animi ducimus voluptatum. Perferendis, cum. Veniam obcaecati temporibus perspiciatis aperiam.',

            'full_address' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet, dolorem neque ab cum dicta earum illum beatae cupiditate possimus hic.',
            'status' => mt_rand(0, 2),
            'rent_type_id' => $rentType,
            'area_id' => $area,
            'poster_id' => $poster,
            'moderator_id' => $moderator
        ];
    }
}
