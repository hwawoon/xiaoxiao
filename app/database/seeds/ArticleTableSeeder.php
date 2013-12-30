<?php
/**
 * Created by PhpStorm.
 * User: mini
 * Date: 13-12-30
 * Time: 下午2:18
 */

class ArticleTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('articles')->delete();

        Article::create(
            array(
                'title' => '唧唧复唧唧1',
                'savepath' => 'upload/a1Am638_460s_v1.jpg',
                'userid' => 1
            )
        );

        Article::create(
            array(
                'title' => '唧唧复唧唧2',
                'savepath' => 'upload/a9dzOEZ_460s.jpg',
                'userid' => 1
            )
        );

        Article::create(
            array(
                'title' => '唧唧复唧唧3',
                'savepath' => 'upload/anYO27z_460s.jpg',
                'userid' => 1
            )
        );

        Article::create(
            array(
                'title' => '唧唧复唧唧4',
                'savepath' => 'upload/apq19WD_460s.jpg',
                'userid' => 1
            )
        );

    }

}