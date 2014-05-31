<?php

# Nama Class harus sama dengan nama file
class SeedAdmin extends Seeder {

	# Buat perintah
	public function run() {

		# Kosongkan isi tabel admin
		DB::table('admin')->delete();

		# Inisialisasi isi baru
		$tampung = array(
			'nama' => 'Administrator',
			'username' => 'admin',
			'password' => Hash::make('admins'),
			'created_at' => new DateTime,
			'updated_at' => new DateTime
		);

		# Masukkan isi kedalam tabel
		DB::table('admin')->insert($tampung);
	}
}