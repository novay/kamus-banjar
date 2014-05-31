<?php

/*
|--------------------------------------------------------------------------
| Halaman FrontEnd
|--------------------------------------------------------------------------
*/

#### Halaman Index
Route::get( '/', 					array('as' => 'index', 		'uses' => 'FrontEndController@index'));
#### Daftar per Inisial
Route::get( 'huruf/{inisial}',		array('as' => 'inisial', 	'uses' => 'FrontEndController@inisial'));
#### Pencarian
Route::get('cari',					array('as' => 'cari', 		'uses' => 'FrontEndController@cari'));
#### Arti per Kata
Route::get('arti/{kata}',			array('as' => 'arti', 		'uses' => 'FrontEndController@arti'));

/*
|--------------------------------------------------------------------------
| Halaman BackEnd
|--------------------------------------------------------------------------
*/

# Grup Prefix Kelola
Route::group(array('prefix' => 'admin'), function() {

	#### Autentikasi
	Route::get( '/', 				array('as' => 'beranda', 	'uses' => 'AutentikasiController@index'));
	Route::get( 'masuk', 			array('as' => 'masuk', 		'uses' => 'AutentikasiController@pintu'));
	Route::post('masuk', 			array('as' => 'post-masuk',	'uses' => 'AutentikasiController@masuk'));
	Route::get( 'keluar', 			array('as' => 'keluar',		'uses' => 'AutentikasiController@keluar'));

	#### Pengaturan Aplikasi dan Akun
	Route::get( 'akun', 			array('as' => 'akun', 		'uses' => 'PengaturanController@akun'));
	Route::post('akun', 			array('as' => 'post-akun',	'uses' => 'PengaturanController@ubahAkun'));
	Route::get( 'aplikasi', 		array('as' => 'app', 		'uses' => 'PengaturanController@aplikasi'));
	Route::post('aplikasi',			array('as' => 'post-app', 	'uses' => 'PengaturanController@ubahAplikasi'));

	#### Controller untuk Kamus
	Route::get( 'kamus/buat', 		array('as' => 'buat', 		'uses' => 'KamusController@buat'));
	Route::post('kamus', 			array('as' => 'post-buat', 	'uses' => 'KamusController@postBuat'));
	Route::get( 'kamus/{id}/ubah', 	array('as' => 'ubah', 		'uses' => 'KamusController@ubah'));
	Route::post('kamus/{id}', 		array('as' => 'post-ubah', 	'uses' => 'KamusController@postUbah'));
	Route::get( 'kamus/{id}/hapus',	array('as' => 'hapus', 		'uses' => 'KamusController@hapus'));
	Route::post('hapus/list', 		array('as' => 'hapus-list', 'uses' => 'KamusController@hapusList'));
	Route::post('cari/kamus', 		array('as' => 'cari-kamus', 'uses' => 'KamusController@cari'));
	Route::get( 'urut/{jenis}',		array('as' => 'urut-kamus', 'uses' => 'KamusController@urut'));
	
});