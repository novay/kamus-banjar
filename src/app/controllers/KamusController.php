<?php

/*
|--------------------------------------------------------------------------
| Controller Kamus
|--------------------------------------------------------------------------
| Sesuaikan nama class dengan nama file 
*/
class KamusController extends \BaseController {

	/*
	|--------------------------------------------------------------------------
	| Koleksi Filter Controller
	|-------------------------------------------------------------------------- */
	public function __construct() {

		# Filter Auth keseluruh method. Baca 'filters.php' baris 22
		$this->beforeFilter('auth');

	}

	/*
	|--------------------------------------------------------------------------
	| Form Buat Kamus Baru | GET | localhost/admin/kamus/buat
	|-------------------------------------------------------------------------- */
	public function buat() {

		# Tentukan Judul
		$judul = 'Tambah Data Kamus';
		
		# Langsung tampilkan view
		return View::make('admin.tambah', compact('judul'));

	}


	/*
	|--------------------------------------------------------------------------
	| Proses Pembuatan Kamus Baru | POST | localhost/admin/kamus
	|-------------------------------------------------------------------------- */
	public function postBuat() {
		
		# Simpan semua inputan kedalam variabel input
		$input = Input::all();

		# Aturan Validasi dengan syarat :
		# - Bahasa Banjar wajib diisi
		# - Bahasa Indonesia wajib diisi
		$aturan = array(
			'banjar'	=> 'required', 
			'indo'		=> 'required'
		);

		# Keterangan validasi untuk setiap syarat
		$keterangan = array(
			'banjar.required'	=> 'Kata dalam bahasa banjar masih kosong.',
			'indo.required'		=> 'Arti dalam Indonesia masih kosong.'
		);

		# Koleksi semua aturan beserta keterangan kedalam variabel 'v'
		$v = Validator::make($input, $aturan, $keterangan);

		# Bila validasi gagal
		if($v->fails())

			# Kembali kehalaman dengan masing-masing pesan error
			return Redirect::back()->withErrors($v)->withInput();

		# Bila sukses, simpan data dalam database
		Kamus::create(array(
			'banjar' 	=> Input::get('banjar'),
			'indo'		=> Input::get('indo')
		));

		# Setelah disimpan kembali kehalaman beranda dengan pesan sukses
		return Redirect::route('beranda')->withPesan('Istilah baru berhasil ditambahkan.');

	}


	/*
	|--------------------------------------------------------------------------
	| Form Ubah Informasi Kamus | GET | localhost/admin/kamus/{id}/ubah
	|-------------------------------------------------------------------------- */
	public function ubah($id) {
		
		# Temukan id kamus yang dimaksud
		$kamus = Kamus::find($id);

		# Tentukan judul
		$judul = 'Ubah Informasi Kamus';

		# Kirim isi variabel bersama view
		return View::make('admin.ubah', compact('kamus', 'judul'));

	}

	/*
	|--------------------------------------------------------------------------
	| Proses Ubah Informasi Kamus | POST | localhost/admin/kamus/{id}
	|-------------------------------------------------------------------------- */
	public function postUbah($id) {
		
		# Simpan semua inputan kedalam variabel input
		$input = Input::all();

		# Aturan Validasi dengan syarat :
		# - Banjar wajib diisi
		# - Indonesia wajib diisi
		$aturan = array(
			'banjar'	=> 'required', 
			'indo'		=> 'required'
		);

		# Keterangan validasi untuk setiap syarat
		$keterangan = array(
			'banjar.required'	=> 'Kata dalam bahasa banjar masih kosong.',
			'indo.required'		=> 'Arti dalam Indonesia masih kosong.'
		);

		# Koleksi semua aturan beserta keterangan kedalam variabel 'v'
		$v = Validator::make($input, $aturan, $keterangan);

		# Bila validasi gagal
		if($v->fails())

			# Kembali kehalaman sama dengan pesan error
			return Redirect::back()->withErrors($v)->withInput();

		# Temukan ID kamus yang ingin diubah
		$temp =  Kamus::find($id);

		# Lakukan perubahan berdasarkan field
		$temp->banjar 	= Input::get('banjar');
		$temp->indo 	= Input::get('indo');

		# Simpan perubahan
		$temp->save();

		# Kembali kehalaman beranda admin dengan pesan sukses
		return Redirect::route('beranda')->withPesan('Salah satu data kamus berhasil diubah.');
	}


	/*
	|--------------------------------------------------------------------------
	| Proses Hapus Data Kamus | DELETE | localhost/admin/kamus/{id}/hapus
	|-------------------------------------------------------------------------- */
	public function hapus($id) {
		
		# Hapus berdasarkan id
		$hapus = Kamus::destroy($id);

		# Kembali kehalaman index dengan pesan sukses
		return Redirect::route('beranda')->withPesan('Data Kamus berhasil dihapus.');

	}

	/*
	|--------------------------------------------------------------------------
	| Proses Hapus Semua Ceklis | GET | localhost/admin/kamus/list
	|-------------------------------------------------------------------------- */
	public function hapusList() {

		# Ambil inputan dari form
		$input = Input::get('id');
		
		# Lakukan penghapusan data secara looping
		for($i = 0; $i < sizeof($input); $i++) {

			# Temukan ID yang dicentang
			$id = $input[$i];

			# Hapus berdasarkan ID
			Kamus::destroy($id);

		}

		# Kembali kehalaman sama dengan pesan sukses
		return Redirect::route('beranda')->withPesan('Beberapa data Kamus berhasil dihapus.');

	}

	/*
	|--------------------------------------------------------------------------
	| Proses Hapus Data Kamus | DELETE | localhost/admin/cari/kamus
	|-------------------------------------------------------------------------- */
	public function cari() {

		# Ambil nilai inputan dari form
		$keyword = Input::get('cari');

		# Buatkan daftar yang sama persis dengan kata kunci
		$cari = Kamus::where('banjar', $keyword)->orWhere('indo', $keyword)->get();

		# Buatkan daftar yang mendekati dengan kata kunci yang dicari
		$daftar = Kamus::where('indo', 'LIKE', "%$keyword%")->orWhere('banjar', 'LIKE', "%$keyword%")->get();

		# Buat judul pencarian
		$judul = 'Hasil Pencarian "'. $keyword . '"';

		# Tampilkan halaman pencarian
		return View::make('admin.cari', compact('judul', 'daftar', 'cari'));

	}

	/*
	|--------------------------------------------------------------------------
	| Halaman Index Sorting Daftar | GET | localhost/admin/
	|-------------------------------------------------------------------------- */
	public function urut($jenis) {

		# Jika jenis yang diterima adalah banjar
		if($jenis === 'banjar') {

			# Tarik semua data kamus dan urutkan sesuai abjat banjar
			$daftar = Kamus::orderBy('banjar', 'ASC')->paginate(10);

		# Jika jenis yang diterima indonesia
		} elseif($jenis === 'indo') {

			# Tarik semua data kamus dan urutkan sesuai abjat indonesia
			$daftar = Kamus::orderBy('indo', 'ASC')->paginate(10);

		# Selain kedua jenis diatas
		} else {

			# Buat judul error
			$judul = '';

			# Tampilkan halaman error
			return Response::view('404', compact('judul'));

		}

		# Tentukan Judul
		$judul = 'Selamat Datang, ' . Auth::user()->nama;

		# Tampilkan View Beranda Admin
		return View::make('admin.index', compact('daftar', 'judul'));

	}

}