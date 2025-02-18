# Sistem Inventori Gudang 🏭

Sistem Inventori Gudang adalah aplikasi web berbasis Laravel yang memudahkan manajemen stok barang, pencatatan transaksi barang masuk/keluar, dan pelaporan inventori di gudang.

![Logo Sistem Inventori Gudang](https://via.placeholder.com/1200x400?text=Logo+Sistem+Inventori+Gudang)

## 🚀 Fitur Utama

### 🛠️ Manajemen Produk
- **Tambah, edit, dan hapus produk**
- **Tracking stok barang secara real-time**
- **Kategorisasi produk**
- **Detail informasi produk (kode, nama, harga, stok)**

### 🔄 Manajemen Transaksi
- **Pencatatan barang masuk**
- **Pencatatan barang keluar**
- **Riwayat transaksi**
- **Update stok otomatis**

### 📦 Manajemen Kategori
- **Pengelompokan produk berdasarkan kategori**
- **Organisasi inventori yang lebih terstruktur**

### 🔐 Sistem Autentikasi
- **Multi-user (Admin & Staff)**
- **Login yang aman menggunakan autentikasi Laravel**
- **Manajemen akses pengguna berdasarkan peran**

---

## 🖥️ Teknologi yang Digunakan

- **Laravel 10**
- **PHP 8.1+**
- **MySQL Database**
- **Bootstrap 5**
- **JavaScript/jQuery**
- **Font Awesome Icons**

---

## ⚙️ Persyaratan Sistem

- **PHP >= 8.1**
- **Composer**
- **MySQL**
- **Node.js & NPM**
- **Web Server (Apache/Nginx)**

---

## 📥 Instalasi

1. Clone repository:
   ```bash
   git clone https://github.com/username/inventori-gudang.git


1. Clone repository:
   ```bash
   git clone https://github.com/username/inventori-gudang.git
   ```

2. Masuk ke direktori project:
   ```bash
   cd inventori-gudang
   ```

3. Install dependencies:
   ```bash
   composer install
   ```

4. Setup environment:
   Salin file `.env.example` menjadi `.env`:
   ```bash
   cp .env.example .env
   ```

5. Konfigurasi database di file `.env`:
   ```env
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. Jalankan migrasi dan seeding:
   ```bash
   php artisan migrate --seed
   ```

## Akun Default

- **Admin**  
  Email: `admin@admin.com`  
  Password: `password`

- **Staff**  
  Email: `staff@staff.com`  
  Password: `123`

## Penggunaan
1. Login dengan akun default
2. Kelola kategori dan produk
3. Catat transaksi barang masuk/keluar
4. Monitor perubahan stok barang secara real-time
5. Cetak laporan sesuai kebutuhan

## Kontribusi
Jika Anda ingin berkontribusi pada proyek ini, silakan ikuti langkah-langkah berikut:
1. Fork repository ini
2. Buat branch baru untuk fitur yang ingin Anda tambahkan:
   ```bash
   git checkout -b fitur-baru
   ```
3. Lakukan commit perubahan:
   ```bash
   git commit -m 'Menambahkan fitur baru'
   ```
4. Push branch Anda:
   ```bash
   git push origin fitur-baru
   ```
5. Buat Pull Request untuk menggabungkan perubahan Anda.

## Lisensi
Aplikasi ini bersifat open source dan dilisensikan di bawah **MIT License**.

## Kontak
Jika ada pertanyaan atau masukan, silakan hubungi saya di:
- **Email**: [iqbalgarut0@gmail.com]

## 📸 Screenshots

### 🔑 Halaman Login
![Halaman Login](https://github.com/user-attachments/assets/55dd03ec-5560-42e0-992a-605b4d1f9494)

### 📊 Halaman Dashboard
![Halaman Dashboard](https://github.com/user-attachments/assets/5bd0bc41-2aec-4099-bef6-783651d5df37)

### 📦 Halaman Produk
![Halaman Produk](https://github.com/user-attachments/assets/e5aa4890-31c1-4564-a88b-bacadebe6ee3)

### ➕ Halaman Tambah Produk
![Halaman Tambah Produk](https://github.com/user-attachments/assets/b9fed040-a7f4-4832-ac73-1788b9ef790e)

### ✏️ Halaman Update Produk
![Halaman Update Produk](https://github.com/user-attachments/assets/7ced59d9-4a22-4587-b9c0-53e3eeb8a9a4)

### 🏷️ Halaman Kategori Produk
![Halaman Kategori Produk](https://github.com/user-attachments/assets/b8b250e4-d3e4-45a9-9bfd-eb68b04fe403)

### ➕ Halaman Tambah Kategori Produk
![Halaman Tambah Kategori Produk](https://github.com/user-attachments/assets/8d736ef3-28dd-4d09-a1d2-bcf3d391e863)

### ✏️ Halaman Update Kategori Produk
![Halaman Update Kategori Produk](https://github.com/user-attachments/assets/b1172e01-65e1-496d-8bb7-92c2bc7d92b6)

### 💳 Halaman Transaksi
![Halaman Transaksi](https://github.com/user-attachments/assets/ac622d28-dfe4-475d-969d-6f2be1a6d6cc)

### ➕ Halaman Tambah Transaksi
![Halaman Tambah Transaksi](https://github.com/user-attachments/assets/438c44be-23e5-4faf-b65e-eab53e55fce5)

### ✏️ Halaman Update Transaksi
![Halaman Update Transaksi](https://github.com/user-attachments/assets/40b47607-21a3-4d40-8584-6634348a5e4a)


```

