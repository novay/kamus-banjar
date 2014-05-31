<?php

# Nama class harus sesuai dengan nama file
class Kamus extends Eloquent {

	# Tentukan nama tabel
	protected $table = 'kamus';

	# Mass Assignment
	protected $fillable = array('banjar', 'indo', 'inisial', 'kunjungan');
	
}