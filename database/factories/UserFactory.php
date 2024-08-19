<?php

namespace WPWCore\Database\Factories;

use Carbon\Carbon;
use WPWCore\Database\Eloquent\Factories\Factory;
use function WPWCore\config;

/**
 * @extends \WPWCore\Database\Eloquent\Factories\Factory<\FiteCard\Models\BunnyStreamVideos>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $faker = \Faker\Factory::create();




        return [
            "library_id"=>$faker->numberBetween(4,8),
            "video_title"=>$faker->word(),
            "video_id"=>$faker->uuid(),
            "video_meta"=>[],
            "processing_status"=>0,

            "finished_at"=>null,
            "views"=>5,
            "length"=>10

        ];
    }
}
