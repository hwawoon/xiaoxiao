<?php

class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->delete();

        Article::create(
            array(
                'title' => '唧唧复唧唧1',
                'savepath' => 'upload/a1Am638_460s_v1.jpg',
                'userid' => 1,
                'comments' => 0,
                'up' => 200,
                'down' => 50
            )
        );

    }

}