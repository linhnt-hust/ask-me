<?php

use Illuminate\Database\Seeder;

class PollsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('poll_fields')->truncate();
        Schema::enableForeignKeyConstraints();
        factory(App\Models\Poll::class, 70)->create();
    }
}
