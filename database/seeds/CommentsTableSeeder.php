<?php

use Illuminate\Database\Seeder;

// Includo a mano i 2 use qui sotto
use Faker\Generator as Faker;
use App\Comment;
// Devo interagire con il Model 'Post' quindi lo devo importare
use App\Post;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        // 1. seleziono solo i post pubblicati
        $posts = Post::where('published', 1)->get();
        // 2. ciclo sui posts
        foreach($posts as $post) {
            // 3. creo un ciclo che generi da 0 a 3 commenti
            for($i = 0; $i < rand(0, 3); $i++){

                $newComment = new Comment();

                $newComment->post_id = $post->id;
                $newComment->name = $faker->name();
                $newComment->content = $faker->text();

                $newComment->save();
            }
        }
    }
}
