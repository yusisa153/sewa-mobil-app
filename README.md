Sewa Mobil App
Aplikasi manajemen persewaan mobil

Fitur:
1. Registrasi pengguna - Belum selesai
2. Manajemen mobil :
    a. Pengguna dapat menambahkan mobil baru kedalam sistem dengan mengisi detail form yang disediakan
    b. Pengguna dapat mengakses kembali data mobil yang telah di tambahkan
    c. Pengguna dapat mencari mobil berdasarkan merek, model dan ketersediaan - Belum selesai
3. Peminjaman mobil :
    a. Pengguna dapat memesan mobil dengan memasukkan tanggal mulai dan tanggal selesai penyewaan, serta memilih mobil yang tersedia dengan klik +sewa baru
    b. Sistem telah memverifikasi ketersediaan mobil pada tanggal yang diminta ke dalam list mobil yang bisa dipinjam yang dapat di lihat dalam drop down di form yang telah disediakan
    c. Data peminjaman yang telah disimpan dan bisa diakses kembali
    d. Pengguna bisa melihat kembali list daftar mobil yang sedang disewa 
4. Pengembalian mobil:
    a. Pengguna bisa mengembalikan mobil dengan memilih drop down plat nomor mobil yang disewa
    b. Pengguna bisa melakukan verivikasi setelah plat nomor di pilih, jumlah hari penyewaan dan total biaya sewa
5. Logout pengguna - Belum selesai

Requirement
1. Laravel 10
2. PHP 8.3.7

Setup
1. Migrasi tabel yang dibutuhkan ke dalam database
    php artisan migrate:fresh --seed

Running
1. Start web server di terminal lain
    php artisan serve
2. Buka url yang tampil melalui browser
    http://127.0.0.1:8000
