# Aplikasi PIP Guard - Laravel + MetaMask
Aplikasi ini dibuat untuk membantu proses pencairan dan pelaporan dana PIP secara transparan, serta mencatat transaksi ke dalam blockchain menggunakan MetaMask.
## Teknologi yang Digunakan
- Laravel 10 (Backend + Frontend)
- Bootstrap 5 (UI)
- MetaMask (Integrasi Blockchain via Web3.js)
- MySQL (Database)

## Fitur Utama
- Login & Autentikasi (Admin & Siswa)
- Pencairan Dana oleh Admin
- Konfirmasi Dana oleh Siswa
- Catat transaksi ke Blockchain (via MetaMask)
- Riwayat dan Laporan Transaksi
- UI interaktif dan ringan


## Cara Menjalankan Proyek
### 1. Clone Repo
1. git clone https://github.com/Amelia311/be_tubes.git
2. cd be_tubes

### 2. Setup Laravel
1. composer install
2. cp .env.example .env
3. php artisan key:generate
4. php artisan migrate --seed
5. php artisan storage:link
6. php artisan serve

### 3. Konfigurasi MetaMask
1. Install ekstensi MetaMask di browser
2. Gunakan jaringan Sepolia
3. Tambahkan akun test ke MetaMask
4. Pastikan koneksi Web3 aktif di browser

## Konfigurasi MetaMask (Sepolia)
1. Buka MetaMask dan pilih jaringan Sepolia
2. Salin alamat wallet (0x...)
3. Buka link berikut untuk menambahkan saldo ETH
https://cloud.google.com/application/web3/faucet/ethereum/sepolia
4. Tempel alamat wallet dan klik "Receive 0.05 Sepolia ETH"
5. Setelah ETH masuk, reload halaman aplikasi dan coba lakukan konfirmasi transaksi.

## Login Website
1. Admin :
- NPSN : 34566543
- Password : 12345678

2. Siswa (Untuk siswa diharapkan admin menambahkan daftar siswa dulu dan mengisi NISN beserta password. Jika sudah baru bisa login sebagai siswa)