<?php
require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Siswa.php';
require_once __DIR__ . '/../models/Kelas.php';

$siswaModel = new Siswa();
$kelasModel = new Kelas();

$nisn = $_GET['nisn'] ?? '';

if (!preg_match('/^[0-9]{10}$/', $nisn)) {
    header("Location: index.php?pesan=NISN tidak valid");
    exit;
}

$siswa = $siswaModel->getByNisn($nisn);

if (!$siswa) {
    header("Location: index.php?pesan=Siswa tidak ditemukan");
    exit;
}

$dataKelas = $kelasModel->getAll();

$nama = $siswa['nama'];
$alamat = $siswa['alamat'] ?? '';
$id_kelas = $siswa['id_kelas'];
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $id_kelas = $_POST['id_kelas'] ?? '';

    if ($nama === '') {
        $error = "Nama siswa wajib diisi.";
    } elseif (mb_strlen($nama) > 100 ||
              mb_strlen($alamat) > 255) {
        $error = "Nama atau alamat terlalu panjang.";
    } elseif (!ctype_digit((string)$id_kelas) ||
              !$kelasModel->getById((int)$id_kelas)) {
        $error = "Pilih kelas yang terdaftar.";
    } else {
        try {
            $siswaModel->ubah(
                $nisn,
                $nama,
                $alamat,
                (int)$id_kelas
            );

            header("Location: index.php?pesan=" .
                   urlencode("Data siswa berhasil diubah"));
            exit;
        } catch (PDOException $e) {
            $error = "Gagal mengubah data siswa.";
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<h2>Edit Siswa</h2>

<?php if ($error): ?>
    <p style="color:red;">
        <?= htmlspecialchars($error) ?>
    </p>
<?php endif; ?>

<form method="POST">

    <label>NISN</label><br>
    <input type="text"
           value="<?= htmlspecialchars($nisn) ?>"
           readonly>

    <br><br>

    <label>Nama Siswa</label><br>
    <input type="text" name="nama"
           maxlength="100"
           value="<?= htmlspecialchars($nama) ?>"
           required>

    <br><br>

    <label>Alamat</label><br>
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

    <button type="submit">Simpan Perubahan</button>
    <a href="index.php">Batal</a>
</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
