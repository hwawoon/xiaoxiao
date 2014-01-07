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
                'comments' => 100,
                'up' => 200,
                'down' => 50
            )
        );

        Article::create(
            array(
                'title' => '唧唧复唧唧2',
                'savepath' => 'upload/a9dzOEZ_460s.jpg',
                'userid' => 1,
                'comments' => 16,
                'up' => 100,
                'down' => 20
            )
        );

        Article::create(
            array(
                'title' => '唧唧复唧唧3',
                'savepath' => 'upload/anYO27z_460s.jpg',
                'userid' => 1,
                'comments' => 11,
                'up' => 323,
                'down' => 123
            )
        );

        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/apq19WD_460s.jpg',
                'userid' => 1,
                'comments' => 453,
                'up' => 123,
                'down' => 2324
            )
        );

        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/1.jpg',
                'userid' => 1,
                'comments' => 324,
                'up' => 12,
                'down' => 3121
            )
        );

        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/2.jpg',
                'userid' => 1,
                'comments' => 12,
                'up' => 321,
                'down' => 24
            )
        );
        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/3.jpg',
                'userid' => 1,
                'comments' => 33,
                'up' => 2222,
                'down' => 345
            )
        );
        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/4.jpg',
                'userid' => 1,
                'comments' => 321,
                'up' => 12,
                'down' => 32
            )
        );
        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/5.jpg',
                'userid' => 1,
                'comments' => 232,
                'up' => 200,
                'down' => 33
            )
        );
        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/6.jpg',
                'userid' => 1,
                'comments' => 123,
                'up' => 10120,
                'down' => 1231
            )
        );
        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/7.jpg',
                'userid' => 1,
                'comments' => 1234,
                'up' => 123,
                'down' => 123
            )
        );
        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/8.jpg',
                'userid' => 1,
                'comments' => 123,
                'up' => 123,
                'down' => 32
            )
        );
        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/9.jpg',
                'userid' => 1,
                'comments' => 12,
                'up' => 100,
                'down' => 20
            )
        );
        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/10.jpg',
                'userid' => 1,
                'comments' => 65,
                'up' => 123,
                'down' => 20
            )
        );

    }

}