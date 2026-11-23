
<?php

require_once __DIR__ . '/../includes/auth.php';
require_once __DIR__ . '/../models/Presensi.php';

$presensiModel = new Presensi();

$pesan = "";
$status = false;
$nisn = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nisn = trim($_POST['nisn'] ?? '');

    if (!preg_match('/^[0-9]{10}$/', $nisn)) {
        $pesan = "NISN harus terdiri dari 10 digit angka.";
    } else {
        try {
            $hasil = $presensiModel->tapKartu($nisn);

            $status = $hasil['status'];
            $pesan = $hasil['pesan'];

            if ($status) {
                $nisn = "";
            }

        } catch (PDOException $e) {
            $pesan = "Gagal mencatat presensi.";
        }
    }
}

require_once __DIR__ . '/../includes/header.php';
require_once __DIR__ . '/../includes/navbar.php';
?>

<h2>Simulasi Tap Kartu RFID</h2>

<p>Masukkan NISN siswa untuk mencatat kehadiran.</p>

<?php if ($pesan !== ""): ?>
    <p style="color: <?= $status ? 'green' : 'red' ?>;">
        <?= htmlspecialchars($pesan) ?>
    </p>
<?php endif; ?>

<form method="POST">

    <label>NISN Siswa</label>
    <br>

    <input
        type="text"
        name="nisn"
        maxlength="10"
        inputmode="numeric"
        placeholder="Masukkan 10 digit NISN"
        value="<?= htmlspecialchars($nisn) ?>"
        required
        autofocus
    >

    <br><br>

    <button type="submit">Tap Kartu</button>

</form>

<?php require_once __DIR__ . '/../includes/footer.php'; ?>
