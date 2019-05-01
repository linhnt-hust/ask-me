<?php

use Illuminate\Database\Seeder;
use App\Models as Database;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('blogs')->truncate();

        $blogs = [
            ['This is my first blog', '1', 'Is Howard Starks Super Soldier Serum in civil WAR ultimately superior to the numerous versions that came before it?', '2', '0', 'google.com.vn'],
        ];

        foreach ($blogs as $blog) {
            Database\Blog::create([
                'title' => $blog[0],
                'user_id' => $blog[1],
                'description' => $blog[2],
                'type' => $blog[3],
                'approve_status' => $blog[4],
                'url' => $blog[5],
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]);

        }

        factory(App\Models\Blog::class, 25)->create();

        Schema::enableForeignKeyConstraints();
    }
}
