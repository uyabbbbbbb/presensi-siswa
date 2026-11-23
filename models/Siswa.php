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

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
