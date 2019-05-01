<?php

use Illuminate\Database\Seeder;
use App\Models as Database;

class AdminsTableSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('admins')->truncate();

        $users = [
            ['adminRin', 'admin@gmail.com', '111111', 'truong dinh, ha noi', 'users.png', 'dang cong san viet nam quang vinh muon nam'],
        ];

        foreach ($users as $user) {
            Database\Admin::create([
                'name' => $user[0],
                'email' => $user[1],
                'password' => Hash::make($user[2]),
                'address' => $user[3],
                'avatar' => $user[4],
                'description' => $user[5],
            ]);

        }

        factory(App\Models\Admin::class, 20)->create();

        Schema::enableForeignKeyConstraints();
    }
}
