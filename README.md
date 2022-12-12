## Cara konfigurasi repo ini di komputer local

1. Gunakan PHP versi 8.0 atau lebih. Untuk mengeceknya, buka Terminal dan ketik `php -v`
2. Pastikan Composer dan NPM juga terpasang. Untuk mengeceknya, buka Terminal dan ketik `composer --version` dan juga `npm -v`
3. Clone repo ini.
4. `cd` ke direktori reponya di komputer kamu.
5. Ketik perintah `composer install` untuk menginstall dependency PHP.
6. Ketik perintah `npm install` untuk menginstall dependency Javascript.
7. Buat database baru.
8. Copy file .env.example dan paste dengan nama .env
9. Ganti nama databasenya sesuai dengan database yang kamu buat.
10. Jalankan perintah `php artisan migrate --seed` untuk membuat table dan mengisi data dummy
11. Jalankan perintah `php artisan key:generate` untuk membuat key Laravel.
12. Jalankan perintah `npm run dev` agar aset frontend di compile. Karena menggunakan asset tooling bernama Vite, setiap perubahan HTML dan CSS akan refresh otomatis di browser.

## Library yang digunakan untuk mempercepat coding
1. WireUI https://livewire-wireui.com/docs/get-started (cek dulu disini jika ingin menambahkan tombol, input, icon, dropdown, dan element lainnya)
2. TailwindCSS template: https://flowbite.com/docs/getting-started/introduction/ (jika dirasa tidak ditemukan di WireUI, pakai disini)
3. Sudah juga saya siapkan Blade component untuk tabel supaya semuanya selaras.

## Daftar extension VS Code yang harus dipasang untuk mempermudah coding di Laravel (langsung search keyword di bawah di Extension VS Code)
1. Alpine.js Intellisense
2. Auto Close Tag
3. Auto Rename Tag
4. Laravel Blade Formatter
5. Laravel Blade Snippet
6. Laravel Extra Intellisense
7. Laravel Snippets
8. Livewire Language Support
9. php cs fixer
10. PHP Intelephense
11. PHP Namespace Resolver
12. Tailwind CSS IntelliSense

## Best practice dalam menulis kode
- Beri nama variable yang singkat dan jelas menggunakan camelCase.
- Untuk variable yang memiliki lebih dari satu data, tambahkan huruf 's' dibelakang variable. Contoh:
```
// satu data
$buku = Buku::find(1);
$warnaPelangi = 'merah';

// lebih dari satu
$bukus = Buku::where('nama', 'like', '%naruto%')->get();
$warnaPelangis = ['merah', 'kuning', 'hijau'];
```
- untuk meminimalisir bug atau kesalahan di kemudian hari, gunakan tipe data ketika membuat variable atau method. Contoh:
```
public string $benda = 'meja'; //variable $benda hanya bisa diisi string saja
public array $bendas = ['meja', 'kursi', 'piring']; //variable $bendas hanya bisa diisi array saja
public int|bool $isBoleh = true; //variable boleh diisi integer, boleh diisi boolean

//begitu juga untuk method, berikan tipe data atau return type-nya

protected function rules(): array
{
  return [
    'email' => 'required|email',
    'nama' => 'Admin',
  ];
}
```

- Gunakan Blade Component jika kode HTML yang sama dipakai berulang kali. Contohnya bisa dilihat pada component nav-link.blade.php dan digunakan pada app.blade.php
- Gunakan selalu Eloquent untuk mengambil data.
- Pahami konsep Global Scope dan Local Scope untuk Model di dokumentasi resmi Laravel. Contoh untuk Scope bisa di cek pada menu Pengguna.
