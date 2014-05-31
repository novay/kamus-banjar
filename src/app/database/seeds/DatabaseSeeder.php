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

		// $this->call('UserTableSeeder');

		# Eksekusi SeedAdmin & SeedAplikasi
		$this->call('SeedAdmin');
		$this->call('SeedAplikasi');
	}

}