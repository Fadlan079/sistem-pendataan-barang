# 📦 Sistem Pendataan Barang

Sistem berbasis web untuk mengelola inventaris barang, kategori produk, dan data pengguna secara terstruktur. Dibangun menggunakan **Laravel 12**, **Tailwind CSS v4**, dan **Alpine.js** untuk tampilan yang modern dan responsif.

---

## 📖 Latar Belakang

Pengelolaan data barang atau inventaris secara manual (menggunakan buku catatan atau spreadsheet) sering kali menimbulkan berbagai masalah, seperti:

- Data tidak sinkron atau mudah hilang
- Sulitnya melakukan pencarian data barang secara cepat
- Tidak ada pemisahan hak akses antar pengguna
- Proses pelaporan yang lambat dan tidak akurat

Sistem Pendataan Barang hadir sebagai solusi digital yang sederhana namun terstruktur, dirancang untuk lingkungan sekolah, UMKM, atau organisasi kecil yang membutuhkan sistem inventaris ringan berbasis web, dapat diakses dari mana saja, serta mendukung beberapa level pengguna.

---

## ✨ Fitur Utama

| Fitur | Admin | Staff |
|---|:---:|:---:|
| Dashboard Statistik & Grafik | ✅ | ✅ |
| Manajemen Produk (CRUD penuh) | ✅ | ✅ |
| Manajemen Kategori (CRUD penuh) | ✅ | ✅ |
| Manajemen Pengguna & Hak Akses | ✅ | ❌ |
| Pencarian & Filter Data | ✅ | ✅ |
| Paginasi Data | ✅ | ✅ |
| Autentikasi (Login/Logout) | ✅ | ✅ |
| Tampilan Responsif (Mobile-Friendly) | ✅ | ✅ |

---

## 🛠️ Teknologi yang Digunakan

- **PHP 8.2+** & **Laravel 12**
- **MySQL** (Database)
- **Tailwind CSS v4** (Styling)
- **Alpine.js** (Interaktivitas Frontend)
- **Vite** (Asset Bundler)
- **Font Awesome 6** (Ikon)

---

## ✅ Manfaat Sistem

1. **Efisiensi Pengelolaan Data** — Data barang, kategori, dan pengguna dikelola dalam satu platform terintegrasi.
2. **Pencarian Cepat** — Fitur pencarian dan filter memudahkan menemukan data produk tanpa perlu membuka satu per satu.
3. **Kontrol Hak Akses** — Pemisahan peran Admin dan Staff memastikan keamanan data dan mencegah akses tidak sah.
4. **Notifikasi Stok Menipis** — Sistem secara otomatis menandai produk dengan stok di bawah 5 unit dengan indikator warna merah.
5. **Tampilan Modern & Responsif** — Dapat diakses dengan nyaman dari komputer maupun perangkat mobile.
6. **Mudah Dikembangkan** — Dibangun di atas framework Laravel yang terstruktur (MVC) sehingga mudah untuk ditambah fitur baru.

---

## ⚠️ Kekurangan / Keterbatasan

1. **Belum Ada Fitur Ekspor Data** — Belum tersedia opsi untuk mengekspor data ke format Excel atau PDF.
2. **Tidak Ada Notifikasi Real-time** — Peringatan stok menipis hanya tampil secara visual di tabel, belum ada notifikasi push atau email otomatis.
3. **Belum Ada Fitur Upload Gambar Produk** — Produk saat ini tidak mendukung lampiran foto.
4. **Manajemen Stok Terbatas** — Belum ada fitur riwayat mutasi stok masuk/keluar (transaksi inventaris).
5. **Satu Server Database** — Belum dikonfigurasi untuk replikasi atau backup otomatis database.

---

## 🚀 Cara Setup di Komputer

### Persyaratan Sistem

Pastikan perangkat Anda telah terinstal:

- PHP >= 8.2
- Composer
- Node.js >= 18 & npm
- MySQL / MariaDB
- Git

### Langkah Instalasi

**1. Clone repositori**
```bash
git clone https://github.com/Fadlan079/sistem-pendataan-barang.git
cd sistem-pendataan-barang
```

**2. Install dependensi PHP**
```bash
composer install
```

**3. Install dependensi Node.js**
```bash
npm install
```

**4. Salin file konfigurasi environment**
```bash
cp .env.example .env
```

**5. Generate application key**
```bash
php artisan key:generate
```

**6. Konfigurasi database**

Buka file `.env` dan sesuaikan konfigurasi berikut:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sistem_pendataan_barang
DB_USERNAME=root
DB_PASSWORD=
```

Buat database baru di MySQL dengan nama yang sesuai (contoh: `sistem_pendataan_barang`).

**7. Jalankan migrasi dan seeder**
```bash
php artisan migrate --seed
```

Perintah ini akan membuat semua tabel dan mengisi data awal termasuk akun pengguna default:

| Role | Email | Password |
|------|-------|----------|
| Admin | `admin@test.com` | `password` |
| Staff | `staff@test.com` | `password` |

**8. Jalankan server pengembangan**

Buka **dua terminal** secara bersamaan:

Terminal 1 — Laravel dev server:
```bash
php artisan serve
```

Terminal 2 — Vite asset bundler:
```bash
npm run dev
```

**9. Akses aplikasi**

Buka browser dan kunjungi: **http://127.0.0.1:8000**

---

## 📋 Cara Penggunaan

### Sebagai Admin

1. Login dengan akun admin (`admin@test.com` / `password`)
2. Anda akan diarahkan ke **Dashboard Admin** yang menampilkan metrik statistik dan grafik
3. Gunakan menu sidebar untuk navigasi:
   - **Kelola Produk** — Tambah, lihat detail, edit, dan hapus produk
   - **Kelola Kategori** — Tambah, lihat detail, edit, dan hapus kategori
   - **Kelola Pegawai** — Daftarkan pengguna baru, atur role, edit, dan hapus akun

### Sebagai Staff

1. Login dengan akun staff (`staff@test.com` / `password`)
2. Anda akan diarahkan ke **Dashboard Staff** yang menampilkan ringkasan operasional
3. Gunakan menu sidebar untuk navigasi:
   - **Kelola Produk** — Kelola data produk inventaris
   - **Kelola Kategori** — Kelola klasifikasi kategori barang
   - Menu **Kelola Pegawai** tidak tersedia untuk role Staff

### Fitur Pencarian & Filter

- Di halaman **Kelola Produk**, gunakan kolom pencarian untuk mencari berdasarkan nama atau kode produk
- Gunakan dropdown **Kategori** untuk memfilter produk berdasarkan kategori tertentu
- Klik tombol reset (ikon ↺) untuk menghapus filter aktif

---

## 📁 Struktur Proyek (Singkat)

```
├── app/
│   ├── Http/Controllers/     # Controller CRUD (Product, Category, User, dll.)
│   ├── Models/               # Model Eloquent (Product, Category, User)
│   └── Http/Middleware/      # Middleware autentikasi & role
├── database/
│   ├── migrations/           # Skema tabel database
│   └── seeders/              # Data awal (kategori, produk, user)
├── resources/
│   ├── views/
│   │   ├── admin/            # Halaman khusus Admin
│   │   ├── staff/            # Halaman khusus Staff
│   │   ├── layouts/          # Template layout utama
│   │   └── pages/            # Halaman publik (landing page)
│   └── css/app.css           # Konfigurasi warna & tema Tailwind
└── routes/web.php            # Definisi semua rute aplikasi
```

---

## 📄 Lisensi

Proyek ini dibuat untuk keperluan pembelajaran di **SMKTI Airlangga** — Kelas XI PPLG, Semester 2.

---

*Dibuat dengan ❤️ menggunakan Laravel & Tailwind CSS*
