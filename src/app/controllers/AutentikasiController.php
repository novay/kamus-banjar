<?php

/*
|--------------------------------------------------------------------------
| Controller Autentikasi
|--------------------------------------------------------------------------
| Sesuaikan nama class dengan nama file 
*/
class AutentikasiController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Koleksi Filter Controller
	|-------------------------------------------------------------------------- */
	public function __construct() {

		# Filter Auth hanya untuk method 'index' dan 'keluar'. 
		# Baca 'filters.php' baris 22
		$this->beforeFilter('auth', array('only' => array('index', 'keluar')));

		# Filter Guest hanya untuk method 'pintu'. 
		# Baca 'filters.php' baris 41
		$this->beforeFilter('guest', array('only' => array('pintu')));

	}

	/*
	|--------------------------------------------------------------------------
	| Halaman Index | GET | localhost/admin/
	|-------------------------------------------------------------------------- */
	public function index() {

		# Ambil semua data kamus yang ada
		$daftar = Kamus::orderBy('created_at', 'DESC')->paginate(10);

		# Tetukan Judul
		$judul = 'Selamat Datang, ' . Auth::user()->nama;

		# Tampilkan View Beranda Admin
		return View::make('admin.index', compact('daftar', 'judul'));

	}

	/*
	|--------------------------------------------------------------------------
	| Halaman Login | GET | localhost/admin/masuk
	|-------------------------------------------------------------------------- */
	public function pintu() {

		# Tentukan judul
		$judul = 'Halaman Login';

		# Tampilkan View Form Login
		return View::make('admin.login', compact('judul'));

	}

	/*
	|--------------------------------------------------------------------------
	| Proses Form Login | POST | localhost/admin/masuk
	|-------------------------------------------------------------------------- */
	public function masuk() {

		# Simpan semua inputan kedalam variabel input
		$input = Input::all();

		# Aturan Validasi dengan syarat :
		# - Username wajib diisi, minimal 5 karakter, maksimal 20 karakter
		# - Password wajib diisi, minimal 5 karakter
		$aturan = array(
			'username' => 'required|min:5|max:20', 
			'password' => 'required|min:5'
		);

		# Keterangan validasi untuk setiap syarat
		$keterangan = array(
			'username.required' => 'Nama Pengguna masih kosong.',
			'username.min'		=> 'Nama Pengguna minimal 5 karakter.',
			'username.max'		=> 'Nama Pengguna maksimal 20 karakter.',
			'password.required'	=> 'Kata Sandi masih kosong.',
			'password.min'		=> 'Kata Sandi minimal 5 karakter.'
		);

		# Koleksi semua aturan beserta keterangan kedalam variabel 'v'
		$v = Validator::make($input, $aturan, $keterangan);

		# Bila validasi gagal
		if($v->fails())

			# Kembali kehalaman sama dengan pesan error tanpa inputan password
			return Redirect::back()
						->withErrors($v)
						->withInput(Input::except('password'));

		# Sedangkan bila validasi sukses, koleksi semua inputan satu per satu
		$username = Input::get('username');
		$password = Input::get('password');

		# Gabungkan kedua inputan untuk kepentingan verifikasi
		$verifikasi = compact('username', 'password');

		# Bila verifikasi berhasil
		if(Auth::attempt($verifikasi))

			# Masuk kedalam beranda Admin
			return Redirect::route('beranda');

		# Sedangkan bila gagal, kembali kehalaman sama dengan pesan error
		return Redirect::back()
					->withInput(Input::except('password'))
					->withPesan('Username dan Password bermasalah.');

	}

	/*
	|--------------------------------------------------------------------------
	| Keluar dari Sistem | GET | localhost/admin/keluar
	|-------------------------------------------------------------------------- */
	public function keluar() {
		
		# Hapus Session dan Cookies
		Auth::logout();

		# Tampilkan halaman login dengan pesan sukses
		return Redirect::route('masuk')->withPesan('Anda telah keluar dari sistem.');

	}

}