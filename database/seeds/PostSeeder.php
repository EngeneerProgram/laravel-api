<?php
use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 10; $i++) { 
            $post = new Post();
            $post->title = $faker->sentence(3);
            $post->slug = Str::slug($post->title, '-');
            $post->content = $faker->text(500);
            $post->cover_image = 'placeholders/'.$faker->image('public/storage/placeholders/', 600, 300, 'Post', false, true, $post->slug, false);
            $post->save();
        }
    }
}
