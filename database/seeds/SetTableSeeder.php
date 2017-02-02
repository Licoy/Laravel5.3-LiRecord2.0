<?php

use Illuminate\Database\Seeder;

class SetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sites')->insert([
            [
                'title'=>'LiRecord',
                'keywords'=>'lirecord,licoy,留言板,开源',
                'describe'=>'LiRecord留言板 - 记录下生活中的点点滴滴，给未来的自己写一份留言~',
                'logo'=>'/img/logo.png',
                'ico'=>'/img/favicon.ico',
                'footer'=>'<span>LiRecord V2.0</span>',
                'created_at'=>date('Y-m-d H:i:s',time()),
                'updated_at'=>date('Y-m-d H:i:s',time())
            ]
        ]);
    }
}
