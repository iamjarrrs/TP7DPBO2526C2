# JANJI
Saya Afit Fajar Rianto dengan NIM 2501826 mengerjakan Tugas Praktikum pada Mata Kuliah Desain dan Pemrograman Berorientasi Objek (DPBO) untuk keberkahan-Nya maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan. Aamiin

---

# Sistem Peminjaman Inventaris BEM

## 1. Penjelasan Tema Website
Website ini adalah **Sistem Peminjaman Inventaris BEM (Badan Eksekutif Mahasiswa)** yang dirancang untuk mengelola pendataan inventaris barang, pengelompokan kategori barang, serta pencatatan transaksi peminjaman barang oleh mahasiswa atau pengurus BEM secara terstruktur dan transparan.

## 2. Penjelasan Database (`inventaris_db`)
Database terdiri dari **3 entitas (tabel)** dengan relasi *Foreign Key*:
1. **Tabel `kategori`**: Menyimpan data kategori barang (contoh: Atribut, Elektronik, Perlengkapan).
   - `id` (Primary Key)
   - `nama_kategori`
2. **Tabel `barang`**: Menyimpan daftar inventaris barang yang berelasi ke tabel `kategori`.
   - `id` (Primary Key)
   - `id_kategori` (Foreign Key ke `kategori.id`)
   - `nama_barang`
   - `stok`
3. **Tabel `peminjaman`**: Menyimpan data transaksi peminjaman barang yang berelasi ke tabel `barang`.
   - `id` (Primary Key)
   - `id_barang` (Foreign Key ke `barang.id`)
   - `nama_peminjam`
   - `jumlah_pinjam`
   - `status` (Enum: `dipinjam`, `dikembalikan`)

## 3. Penjelasan Flow dari Kode (Arsitektur & Logika)
Aplikasi ini dibangun menggunakan **PHP Native** dengan pendekatan **Object-Oriented Programming (OOP)** serta menerapkan **Prepared Statements** untuk keamanan database dari SQL Injection.

* **Struktur Folder:**
  ```text
  TP8DPBO2526C2/
  ├── class/
  │   ├── kategori.php     # Model OOP CRUD Kategori
  │   ├── barang.php       # Model OOP CRUD Barang (JOIN Kategori)
  │   └── peminjam.php     # Model OOP CRUD Peminjaman (JOIN Barang)
  ├── config/
  │   └── db.php           # Koneksi Database menggunakan PDO
  ├── view/
  │   ├── kategori.php     # Antarmuka & Controller Kategori
  │   ├── barang.php       # Antarmuka & Controller Barang
  │   └── peminjaman.php   # Antarmuka & Controller Peminjaman
  ├── index.php            # Dashboard Utama
  ├── style.css            # Styling Vanilla CSS Kustom
  └── README.md            # Dokumentasi Program
  ```
* **Flow Alur Program:**
  1. **Koneksi (`config/db.php`)**: Menginisialisasi koneksi database MySQL menggunakan PDO dengan *error handling* exception.
  2. **Model Kelas (`class/`)**: Setiap tabel direpresentasikan dalam class OOP. Operasi CRUD menggunakan `$db->prepare()` dan `$stmt->execute()` untuk memastikan keamanan query (Prepared Statements).
  3. **Antarmuka & Aksi (`index.php` & `view/`)**: Pengguna mengakses halaman melalui browser. Setiap aksi form (Create/Update/Delete) diproses di file view masing-masing dengan memanggil method dari class model.

# Dokumentasi
## 3. Dokumentasi

[![YouTube Video](https://img.shields.io/badge/YouTube-Demonstrasi_Gameplay-red?style=for-the-badge&logo=youtube&logoColor=white)](https://youtu.be/jHyekifC324)
