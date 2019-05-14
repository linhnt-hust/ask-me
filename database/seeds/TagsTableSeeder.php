<?php

use Illuminate\Database\Seeder;
use App\Models as Database;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('tags')->truncate();

        $listTags = [
            'love',
            'instagood',
            'photooftheday',
            'beautiful',
            'fashion',
            'cute',
            'followme',
            'food',
            'smile ',
            'nature',
            'friends',
            'summer',
            'girl',
            'art',
            'fun',
            'sky',
            'beach',
            'sunset ',
            'sunrise',
            'flowers',
            'night',
            'tree',
            'clouds',
            'skylovers',
            'dusk ',
            'animals',
            'dog',
            'cat',
            'adorable',
            'boyfriend',
            'girlfriend',
            'forever',
            'together ',
            'hugs',
            'partying',
            'memories',
            'chilling',
            'goodtime',
            'halloween',
            'family',
            'siblings',
            'father',
            'mother',
        ];

        foreach ($listTags as $tag) {
            Database\Tag::create([
                'name_tag' => $tag
            ]);
        }

        Schema::enableForeignKeyConstraints();
    }
}
