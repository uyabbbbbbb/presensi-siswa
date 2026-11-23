\# Aplikasi Presensi Siswa

## Deskripsi

Website ini dibuat untuk mempermudah pencatatan kehadiran siswa. Presensi dilakukan dengan memasukkan NISN siswa yang sudah terdaftar.

Selain untuk presensi, website ini juga bisa digunakan untuk mengelola data kelas, data siswa, dan melihat hasil presensi.

## Fitur Website

- Login dan logout
- Menambah, mengedit, dan menghapus data kelas
- Menambah, mengedit, dan menghapus data siswa
- Mencatat presensi menggunakan NISN
- Melihat hasil presensi siswa
- Mencari dan memfilter data presensi

## Struktur Folder

```text
presensi siswa/
│
├── assets/
│   ├── css/
│   │   └── style.css
│   └── js/
│       └── script.js
│
├── config/
│   └── Database.php
│
├── includes/
│   ├── auth.php
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
│
├── models/
│   ├── BaseModel.php
│   ├── Kelas.php
│   ├── Siswa.php
│   └── Presensi.php
│
├── kelas/
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
│
├── siswa/
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
│
├── presensi/
│   ├── index.php
│   ├── tap.php
│   └── hapus.php
│
├── index.php
├── login.php
├── logout.php
└── README.md
```

## Fungsi Folder

- **assets:** Untuk menyimpan file CSS dan JavaScript.
- **config:** Untuk menghubungkan website ke database.
- **includes:** Berisi bagian website seperti header, navbar, dan footer.
- **models:** Berisi kode untuk mengambil dan mengolah data.
- **kelas:** Berisi halaman untuk mengatur data kelas.
- **siswa:** Berisi halaman untuk mengatur data siswa.
- **presensi:** Berisi halaman untuk mencatat dan melihat presensi.

## Cara Menjalankan

1. Buka Laragon.
2. Simpan folder `presensi siswa` ke dalam folder `C:\laragon\www`.
3. Klik Start All di Laragon.
4. Buka phpMyAdmin, lalu siapkan database `db_presensi`.
5. Import file SQL jika sudah disediakan.
6. Buka browser dan ketik:

   `http://localhost/presensi%20siswa/`

7. Login menggunakan akun yang sudah dibuat.

## Cara Menggunakan

### 1. Data Kelas

Masuk ke menu Kelas. Di halaman ini kita bisa menambahkan kelas baru, mengubah data kelas, atau menghapus kelas yang tidak digunakan.

### 2. Data Siswa

Masuk ke menu Siswa. Untuk menambah siswa, isi NISN, nama, alamat, dan pilih kelasnya. Data siswa yang sudah ada juga bisa diedit atau dihapus.

### 3. Tap Presensi

Masuk ke menu Tap Presensi, kemudian masukkan NISN siswa. Jika NISN terdaftar, sistem akan memproses presensi siswa tersebut.

### 4. Rekap Presensi

Masuk ke menu Rekap Presensi untuk melihat siswa yang sudah melakukan presensi. Data juga bisa dicari atau difilter agar lebih mudah ditemukan.

## Database

Website ini menggunakan database `db_presensi` yang memiliki 4 tabel:

- **users:** Menyimpan akun untuk login.
- **kelas:** Menyimpan data kelas.
- **siswa:** Menyimpan data siswa.
- **presensi:** Menyimpan data kehadiran siswa.

Tabel siswa terhubung dengan tabel kelas menggunakan `id_kelas`, sedangkan tabel presensi terhubung dengan tabel siswa menggunakan `nisn`.

## Teknologi

- PHP Native dengan OOP
- MySQL/MariaDB
- PDO
- HTML, CSS, JavaScript
- Laragon

## Catatan

Sebelum menjalankan website, pastikan Laragon sudah aktif dan database sudah disiapkan agar muncul.
