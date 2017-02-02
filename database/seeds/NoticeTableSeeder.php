<?php

use Illuminate\Database\Seeder;

class NoticeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('notices')->insert([
            [
                'title'=>'LiRecord留言板站点已经搭建成功!',
                'text'=>'LiRecord留言板站点已经搭建成功了!快去对你的站点进行设置吧！',
                'created_at'=>date('Y-m-d H:i:s',time()),
                'updated_at'=>date('Y-m-d H:i:s',time())
            ]
        ]);
    }
}
