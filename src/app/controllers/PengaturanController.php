<?php

/*
|--------------------------------------------------------------------------
| Controller Pengaturan
|--------------------------------------------------------------------------
| Sesuaikan nama class dengan nama file 
*/
class PengaturanController extends BaseController {

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
	| Form Perubahan Akun | GET | localhost/admin/akun
	|-------------------------------------------------------------------------- */
	public function akun() {

		# Set pengguna aktif kedalam variabel 'temp'
		$temp = Auth::user();

		# Tentukan Judul
		$judul = 'Ubah Informasi Akun';
		
		# Tampilkan halaman akun beserta variabel 'temp'
		return View::make('admin.akun', compact('temp', 'judul'));

	}

	/*
	|--------------------------------------------------------------------------
	| Proses Perubahan Akun | POST | localhost/admin/akun
	|-------------------------------------------------------------------------- */
	public function ubahAkun() {

		# Simpan semua inputan kedalam variabel input
		$input = Input::all();

		# Aturan Validasi dengan syarat :
		# - Nama wajib diisi, minimal 5 karakter
		# - Username wajib diisi, minimal 5 karakter, maksimal 20 karakter, tidak boleh sama dengan yang sudah ada
		# - Password wajib diisi, minimal 5 karakter
		$aturan = array(
			'nama'			=> 'required|min:5', 
			'username'		=> 'required|min:5|max:20|unique:admin,username', 
			'password'		=> 'required|min:5',
			'konfirmasi'	=> 'required|same:password',
		);

		# Keterangan validasi untuk setiap syarat
		$keterangan = array(
			'nama.required'		=> 'Nama masih kosong.',
			'nama.min'			=> 'Nama minimal harus 5 karakter.',
			'username.required' => 'Nama Pengguna masih kosong.',
			'username.min'		=> 'Nama Pengguna minimal harus 5 karakter.',
			'username.max'		=> 'Nama Pengguna maksimal harus 20 karakter.',
			'username.unique'	=> 'Nama ini telah terdaftar.',
			'password.required'	=> 'Kata Sandi masih kosong.',
			'password.min'		=> 'Kata Sandi minimal harus 5 karakter.',
			'konfirmasi.required' => 'Konfirmasi Password belum diisi.',
			'konfirmasi.same'	=> 'Konfirmasi Password harus sama dengan Password.'
		);

		# Koleksi semua aturan beserta keterangan kedalam variabel 'v'
		$v = Validator::make($input, $aturan, $keterangan);

		# Bila validasi gagal
		if($v->fails())

			# Kembali kehalaman sama dengan pesan error
			return Redirect::back()->withErrors($v)->withInput();
		
		# Sedangkan bila sukses, set ID pengguna aktif kedalam variabel 'id'
		$id = Auth::user()->id;

		# Gunakan variabel id untuk menentukan field user yang akan diubah
		$temp = User::find($id);

		# Ubah data nama, username dan password sesuai dengan inputan
		$temp->nama 	= Input::get('nama');
		$temp->username = Input::get('username');
		$temp->password = Hash::make(Input::get('password'));

		# Simpan perubahan
		$temp->save();

		# Kembali kehalaman sama dengan pesan sukses
		return Redirect::route('beranda')->withPesan('Perubahan Akun berhasil dilakukan.');

	}

	/*
	|--------------------------------------------------------------------------
	| Form Perubahan Aplikasi | GET | localhost/admin/aplikasi
	|-------------------------------------------------------------------------- */
	public function aplikasi() {

		# Set Aplikasi dalam variabel 'temp'
		$temp = Aplikasi::find(1);

		# Tentukan judul halaman
		$judul = 'Ubah Informasi Aplikasi';
		
		# Tampilkan halaman aplikasi beserta variabel 'temp'
		return View::make('admin.aplikasi', compact('temp', 'judul'));

	}

	/*
	|--------------------------------------------------------------------------
	| Proses Perubahan Aplikasi | POST | localhost/admin/aplikasi
	|-------------------------------------------------------------------------- */
	public function ubahAplikasi() {
		
		# Simpan semua inputan kedalam variabel input
		$input = Input::all();

		# Aturan Validasi dengan syarat : 'Nama', 'Slogan' dan 'Pemilik' wajib diisi
		$aturan = array(
			'nama'		=> 'required', 
			'slogan'	=> 'required', 
			'pemilik'	=> 'required'
		);

		# Keterangan validasi untuk setiap syarat
		$keterangan = array(
			'nama.required'		=> 'Nama masih kosong.',
			'slogan.required'	=> 'Slogan masih kosong.',
			'pemilik.required'	=> 'Pemilik masih kosong.'
		);

		# Koleksi semua aturan beserta keterangan kedalam variabel 'v'
		$v = Validator::make($input, $aturan, $keterangan);

		# Bila validasi gagal
		if($v->fails())

			# Kembali kehalaman sama dengan pesan error
			return Redirect::back()->withErrors($v)->withInput();

		# Sedangkan bila sukses, set aplikasi yang akan diubah
		$temp = Aplikasi::find(1);

		# Ubah data nama, username dan password sesuai dengan inputan
		$temp->nama 	= Input::get('nama');
		$temp->slogan 	= Input::get('slogan');
		$temp->pemilik 	= Input::get('pemilik');

		# Simpan perubahan
		$temp->save();

		# Kembali kehalaman sama dengan pesan sukses
		return Redirect::route('beranda')->withPesan('Perubahan Aplikasi telah dilakukan.');

	}
}