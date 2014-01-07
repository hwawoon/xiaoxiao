<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        $this->call('UserTableSeeder');

        $this->command->info('User table seeded!');

        $this->call('ArticleTableSeeder');

        $this->command->info('Article table seeded!');
	}

}