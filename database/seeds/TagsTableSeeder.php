<?php

use App\tag;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'html',
            'css',
            'js',
            'vuejs',
            'php',
            'laravel'
        ];
        foreach($tags as $tag){
            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->slug = Str::slug($tag, '-');

            $newTag->save();
        }
    }
}
