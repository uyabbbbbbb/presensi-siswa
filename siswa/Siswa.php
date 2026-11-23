<?php

require_once __DIR__ . '/BaseModel.php';

class Siswa extends BaseModel {

    public function __construct() {
        parent::__construct();
    }

    public function getAll() {
        $sql = "SELECT siswa.*, kelas.nama_kelas
                FROM siswa
                INNER JOIN kelas
                ON siswa.id_kelas = kelas.id_kelas
                ORDER BY siswa.nama ASC";

        return $this->pdo->query($sql)->fetchAll();
    }

    public function getByNisn($nisn) {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM siswa WHERE nisn = ?"
        );

        $stmt->execute([$nisn]);
        return $stmt->fetch();
    }

    public function cari($keyword) {
        $stmt = $this->pdo->prepare(
            "SELECT siswa.*, kelas.nama_kelas
             FROM siswa
             INNER JOIN kelas
             ON siswa.id_kelas = kelas.id_kelas
             WHERE siswa.nama LIKE ?
                OR siswa.nisn LIKE ?
             ORDER BY siswa.nama ASC"
        );

        $cari = "%" . $keyword . "%";
        $stmt->execute([$cari, $cari]);

        return $stmt->fetchAll();
    }

    public function tambah($nisn, $nama, $alamat, $id_kelas) {
        $stmt = $this->pdo->prepare(
            "INSERT INTO siswa (nisn, nama, alamat, id_kelas)
             VALUES (?, ?, ?, ?)"
        );

        return $stmt->execute([
            $nisn, $nama, $alamat, $id_kelas
        ]);
    }

    public function ubah($nisn, $nama, $alamat, $id_kelas) {
        $stmt = $this->pdo->prepare(
            "UPDATE siswa
             SET nama = ?, alamat = ?, id_kelas = ?
             WHERE nisn = ?"
        );

        return $stmt->execute([
            $nama, $alamat, $id_kelas, $nisn
        ]);
    }

    public function hapus($nisn) {
        $stmt = $this->pdo->prepare(
            "DELETE FROM siswa WHERE nisn = ?"
        );

        return $stmt->execute([$nisn]);
    }
}
