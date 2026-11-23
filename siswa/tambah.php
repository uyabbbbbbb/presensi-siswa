<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/Kelas.php';

$siswaModel = new Siswa();
$kelasModel = new Kelas();

$dataKelas = $kelasModel->getAll();

$nisn = "";
$nama = "";
$alamat = "";
$id_kelas = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nisn = trim($_POST['nisn'] ?? '');
    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $id_kelas = $_POST['id_kelas'] ?? '';

    if (!preg_match('/^[0-9]{10}$/', $nisn)) {
        $error = "NISN harus 10 digit angka.";
    } elseif ($nama === '') {
        $error = "Nama siswa wajib diisi.";
    } elseif (mb_strlen($nama) > 100 ||
              mb_strlen($alamat) > 255) {
        $error = "Nama atau alamat terlalu panjang.";
    } elseif (!ctype_digit((string)$id_kelas) ||
              !$kelasModel->getById((int)$id_kelas)) {
        $error = "Pilih kelas yang terdaftar.";
    } elseif ($siswaModel->getByNisn($nisn)) {
        $error = "NISN sudah terdaftar.";
    } else {
        try {
            $siswaModel->tambah(
                $nisn,
                $nama,
                $alamat,
                (int)$id_kelas
            );

            header("Location: index.php?pesan=" .
                   urlencode("Siswa berhasil ditambahkan"));
            exit;
        } catch (PDOException $e) {
            $error = $e->getCode() == '23000'
                ? "NISN sudah ada atau kelas tidak valid."
                : "Gagal menambahkan siswa.";
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<h2>Tambah Siswa</h2>

<?php if ($error): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<form method="POST">

    <label>NISN</label><br>
    <input type="text" name="nisn"
           maxlength="10"
           inputmode="numeric"
           value="<?= htmlspecialchars($nisn) ?>"
           required>

    <br><br>

    <label>Nama Siswa</label><br>
    <input type="text" name="nama"
           maxlength="100"
           value="<?= htmlspecialchars($nama) ?>"
           required>

    <br><br>

    <label>Alamat (boleh kosong)</label><br>
    <textarea name="alamat" maxlength="255"><?= htmlspecialchars($alamat) ?></textarea>

    <br><br>

    <label>Kelas</label><br>
    <select name="id_kelas" required>
        <option value="">-- Pilih Kelas --</option>

        <?php foreach ($dataKelas as $kelas): ?>
            <option value="<?= $kelas['id_kelas'] ?>"
                <?= (string)$id_kelas === (string)$kelas['id_kelas']
                    ? 'selected' : '' ?>>
                <?= htmlspecialchars($kelas['nama_kelas']) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <button type="submit">Simpan</button>
    <a href="index.php">Batal</a>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
