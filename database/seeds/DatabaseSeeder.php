<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(NoticeTableSeeder::class);
        $this->call(SetTableSeeder::class);
        $this->call(SetTableSeeder::class);
    }
}
