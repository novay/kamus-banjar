<?php

/*
|--------------------------------------------------------------------------
| Controller Kamus
|--------------------------------------------------------------------------
| Sesuaikan nama class dengan nama file 
*/
class FrontEndController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Halaman Index | GET | localhost/
	|-------------------------------------------------------------------------- */
	public function index() {

		# Kirim ketiga variabel ketampilan
		return View::make('index');

	}

	/*
	|--------------------------------------------------------------------------
	| Halaman per Inisial | GET | localhost/huruf/{inisial?}
	|-------------------------------------------------------------------------- */
	public function inisial($inisial) {

		# Bila panjang inisial 1
		if(strlen($inisial) === 1) {

			# Cari berdasarkan inisial ditabel Banjar
			$banjar = Kamus::where('banjar', 'LIKE', "$inisial%")->get();

			# Cari berdasarkan inisial ditabel Indonesia
			$indo = Kamus::where('indo', 'LIKE', "$inisial%")->get();

			# Kirim semua variabel ke View
			return View::make('huruf', compact('banjar', 'indo', 'inisial'));

		}

		# Bila panjang inisial lebih dari 1, tentukan judul
		$judul = '';

		# Kirim ke Error
		return Response::view('404', compact('judul'));

	}

	/*
	|--------------------------------------------------------------------------
	| Halaman Pencarian Kata | GET | localhost/cari/{kata-kunci?}
	|-------------------------------------------------------------------------- */
	public function cari() {

		# Ambil kata yang dicari
		$keyword = Input::get('kata');

		# Buatkan daftar yang sama persis dengan kata kunci
		$arti = Kamus::where('banjar', $keyword)->first();

		# Buatkan daftar yang mendekati dengan kata kunci yang dicari
		$daftar = Kamus::where('banjar', 'LIKE', "%$keyword%")->get();

		# Untuk bahasa Indonesia
		$indo = Kamus::where('indo', 'LIKE', "%$keyword%")->get();

		# Tampilkan halaman pencarian
		return View::make('cari', compact('arti', 'keyword', 'daftar', 'indo'));

	}

	/*
	|--------------------------------------------------------------------------
	| Halaman per Kata | GET | localhost/arti/{kata?}
	|-------------------------------------------------------------------------- */
	public function arti($kata) {

		# Temukan arti sesuai
		$arti = Kamus::where('banjar', $kata)->first();

		# Kunjungan +1
		$temp = $arti;
		$temp->kunjungan += 1;
		$temp->save();

		# Tampilkan halaman per kata
		return View::make('arti', compact('arti', 'kata'));
	}

}