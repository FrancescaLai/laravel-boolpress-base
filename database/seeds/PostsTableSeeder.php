<?php

use Illuminate\Database\Seeder;

// Includo a mano gli use qui sotto
use App\Post;
use Faker\Generator as Faker;
// Questo qui sotto mi serve x generare lo slug
use Illuminate\Support\Str;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // creo un ciclo per fare 10 Post
        for($i = 0; $i < 10; $i++){

            $newPost = new Post();
            $newPost->title = $faker->sentence();
            $newPost->date = $faker->date();
            $newPost->content = $faker->text();
            $newPost->image = $faker->imageUrl(640, 480, 'animals', true);
            $newPost->slug = Str::slug($newPost->title, '-');
            $newPost->published = rand(0, 1);

            $newPost->save();
        }
    }
}
