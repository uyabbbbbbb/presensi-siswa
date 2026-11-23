# Aplikasi Presensi Siswa

Aplikasi Presensi Siswa adalah website berbasis **PHP Native dengan konsep Object Oriented Programming (OOP)** untuk mengelola kelas, data siswa, dan mencatat kehadiran melalui simulasi tap kartu RFID menggunakan NISN. Project ini dibuat untuk tugas **Uji Unit Kompetensi (UUK) SMK TI Airlangga Samarinda tahun pelajaran 2026/2027**.

## Teknologi

PHP Native (OOP), MariaDB/MySQL, PDO, HTML, CSS, JavaScript, Laragon, dan Visual Studio Code.

## Fitur

- Login dan logout administrator dengan session.
- Dashboard aplikasi.
- Tambah, lihat, ubah, dan hapus kelas.
- Tambah, lihat, ubah, dan hapus siswa.
- Pencarian siswa berdasarkan nama atau NISN, termasuk sebagian nama.
- Simulasi tap kartu RFID menggunakan NISN.
- Rekap presensi, pencarian, filter tanggal/kelas, dan penghapusan log.
- Validasi NISN 10 digit dan pembatasan penghapusan kelas yang masih memiliki siswa.

## Struktur folder

```text
presensi siswa/
├── assets/
│   ├── css/style.css
│   └── js/script.js
├── config/Database.php
├── includes/
│   ├── auth.php
│   ├── header.php
│   ├── navbar.php
│   └── footer.php
├── models/
│   ├── BaseModel.php
│   ├── Kelas.php
│   ├── Siswa.php
│   └── Presensi.php
├── kelas/
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── siswa/
│   ├── index.php
│   ├── tambah.php
│   ├── edit.php
│   └── hapus.php
├── presensi/
│   ├── index.php
│   ├── tap.php
│   └── hapus.php
├── docs/
│   ├── erd.png                  # Tambahkan gambar ERD
│   └── screenshots/
├── index.php
├── login.php
├── logout.php
├── schema.sql
├── seed_admin.php
└── README.md
```

## Cara instalasi

1. Instal Laragon dan jalankan Apache serta MySQL/MariaDB.
2. Simpan project ke `C:\laragon\www\presensi siswa\`.
3. Jalankan `schema.sql` melalui phpMyAdmin atau HeidiSQL untuk membuat database dan tabel. Sesuaikan nama database dengan konfigurasi project.
4. Periksa koneksi di `config/Database.php`.
5. Jika diperlukan, jalankan `seed_admin.php` satu kali untuk membuat akun administrator.
6. Akses `http://localhost/presensi%20siswa/` melalui browser.
7. Login dengan akun administrator yang telah dibuat.

> **Akun demo:** Isi username dan password akun **khusus demo** sebelum pengumpulan. Jangan mengunggah password pribadi atau konfigurasi rahasia.
>
> Username: `[isi username demo]`  
> Password: `[isi password demo]`

## Database dan ERD

Aplikasi menggunakan tabel `users`, `kelas`, `siswa`, dan `presensi`. Satu kelas dapat memiliki banyak siswa, dan satu siswa dapat memiliki banyak catatan presensi. Tabel `users` digunakan untuk autentikasi administrator.

**Tambahkan file ERD di `docs/erd.png` agar gambar di bawah tampil:**

![ERD Aplikasi Presensi Siswa](docs/erd.png)

## Foto tampilan aplikasi

### Dashboard

Tampilan dashboard setelah administrator masuk.

![Dashboard Presensi Siswa](docs/screenshots/dashboard.png)

### Pencarian siswa berdasarkan NISN

Pencarian dengan NISN yang ada di database menampilkan satu data siswa yang sesuai.

![Pencarian NISN ditemukan](docs/screenshots/pencarian-nisn-berhasil.png)

Jika NISN tidak ditemukan, halaman menampilkan keterangan **Tidak ada data siswa**.

![Pencarian NISN tidak ditemukan](docs/screenshots/pencarian-nisn-tidak-ditemukan.png)

## Hasil pengujian UUK

Tabel berikut didasarkan pada **screenshot yang dilampirkan**. Status belum terverifikasi berarti bukti screenshot belum tersedia atau belum menunjukkan hasil sesuai soal.

| No. | Skenario | Hasil yang diharapkan | Hasil dari screenshot | Status |
|---|---|---|---|---|
| 1 | Login menggunakan password salah | Login ditolak dan muncul pesan umum | Muncul pesan **Username atau password salah!** | Sesuai |
| 2 | Mengakses halaman terlindungi tanpa login | Dialihkan ke halaman login | Browser menampilkan **404 Not Found** pada URL `localhost/presensi_siswa/login.php` | Belum sesuai / perlu diuji ulang |
| 3 | Menambahkan siswa dengan NISN 9 digit | Ditolak, pesan validasi jelas, dan input tetap terisi | Browser menolak input dengan pesan **Please match the requested format**; formulir tetap terisi | Ditolak, tetapi pesan server belum terlihat |
| 4 | Menambahkan siswa dengan NISN duplikat | Data ditolak dengan pesan jelas | Muncul pesan **NISN sudah terdaftar atau kelas tidak valid.** | Ditolak; pesan masih umum |
| 5 | Tap kartu menggunakan NISN tidak terdaftar | Presensi ditolak | Screenshot belum dilampirkan | Belum terverifikasi |
| 6 | Tap kartu menggunakan NISN terdaftar | Presensi berhasil dan tampil di rekap hari ini dengan waktu otomatis | Screenshot belum dilampirkan | Belum terverifikasi |
| 7 | Menghapus kelas yang masih memiliki siswa | Penghapusan ditolak | Muncul pesan **Kelas tidak bisa dihapus karena masih memiliki siswa.** | Sesuai |
| 8 | Mencari siswa menggunakan sebagian nama | Hanya siswa yang namanya cocok ditampilkan | Kata kunci **Far** menampilkan siswa **Farles** | Sesuai |

### Bukti 1 — Login menggunakan password salah

![Login salah](docs/screenshots/uji-1-login-salah.png)

### Bukti 2 — Mengakses halaman tanpa login

Screenshot yang tersedia menunjukkan `404 Not Found`, sehingga perlu pengujian ulang menggunakan alamat folder project yang benar.

![Akses tanpa login](docs/screenshots/uji-2-akses-tanpa-login.png)

### Bukti 3 — Menambahkan siswa dengan NISN 9 digit

NISN 9 digit ditolak oleh validasi browser. Untuk membuktikan validasi server-side, perlu screenshot pesan PHP setelah form dikirim.

![NISN 9 digit](docs/screenshots/uji-3-nisn-9-digit.png)

### Bukti 4 — Menambahkan siswa dengan NISN duplikat

![NISN duplikat](docs/screenshots/uji-4-nisn-duplikat.png)

### Bukti 5 — Tap kartu dengan NISN tidak terdaftar

**Belum ada screenshot.** Tambahkan `docs/screenshots/uji-5-tap-ditolak.png` setelah pengujian.

### Bukti 6 — Tap kartu dengan NISN terdaftar

**Belum ada screenshot.** Tambahkan `docs/screenshots/uji-6-tap-berhasil.png` dan screenshot rekap presensi setelah pengujian.

### Bukti 7 — Menghapus kelas yang masih memiliki siswa

![Hapus kelas ditolak](docs/screenshots/uji-7-hapus-kelas.png)

### Bukti 8 — Mencari siswa dengan sebagian nama

![Pencarian sebagian nama](docs/screenshots/uji-8-cari-sebagian-nama.png)

## Keamanan aplikasi

Aplikasi dirancang menggunakan session untuk autentikasi, PDO Prepared Statement untuk query dengan input pengguna, `password_hash()` dan `password_verify()` untuk password, serta `htmlspecialchars()` saat menampilkan data. Hubungan foreign key digunakan untuk menjaga konsistensi data.

## Kesimpulan

Aplikasi Presensi Siswa memanfaatkan PHP OOP dan database relasional untuk mengelola siswa, kelas, dan riwayat kehadiran. Pengujian dilakukan untuk memastikan validasi input, autentikasi, pencarian, dan hubungan data bekerja sesuai ketentuan UUK.
