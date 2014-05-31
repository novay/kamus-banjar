<?php

# Nama class harus sesuai dengan nama file
class Aplikasi extends Eloquent {

	# Tentukan nama tabel
	protected $table = 'aplikasi';

	# False Timestamps karena tidak digunakan
	public $timestamps = false;
	
}