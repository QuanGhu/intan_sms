<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        DB::table('admin')->insert([
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin!23'),
        ]);
    }
}
