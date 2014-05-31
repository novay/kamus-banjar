<?php

# Nama Class harus sama dengan nama file
class SeedAplikasi extends Seeder {

	# Buat perintah
	public function run() {

		# Kosongkan isi tabel aplikasi
		DB::table('aplikasi')->delete();

		# Inisialisasi isi baru
		$tampung = array(
			'nama' 		=> 'Kamus Banjar Indonesia',
			'slogan' 	=> 'Ketika Banjar Menjadi Wajar',
			'pemilik' 	=> 'Noviyanto Rachmady'
		);

		# Masukkan isi kedalam tabel
		DB::table('aplikasi')->insert($tampung);
	}
}