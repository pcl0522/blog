<?php

use Illuminate\Database\Seeder;

class LinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data=[
            [
                'link_name' => '百度',
                'link_title' => '有个链接',
                'link_url' => 'http://www.baidu.com',
                'link_sort'=>1
            ],
            [
                'link_name' => '链接一',
                'link_title' => '有个链接',
                'link_url' => 'http://www.sina.com',
                'link_sort'=>2
            ]
        ];
        DB::table('links')->insert($data);
    }
}
