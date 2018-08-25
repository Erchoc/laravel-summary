<?php

use Illuminate\Database\Seeder;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create('zh_CN');

        for($i = 0; $i < 10; $i++) {
            App\Models\Article::create([
                'title' => $faker->address,
                'author' => $faker->name,
                'content' => $faker->paragraph
            ]);
        }
//        factory(App\Models\Article::class, 100)->create();
    }
}
