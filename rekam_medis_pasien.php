<?php
// Mulai session di awal halaman
session_start();
var_dump($_SESSION);

// Include koneksi ke database
include('dbconn.php');

// Ambil user_id dari session
$user_id = $_SESSION['user_id'];

// Cek apakah session user_id ada, jika tidak, alihkan ke halaman login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah user memiliki role yang benar
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

// Ambil data rekam medis pasien berdasarkan user_id
$query = "SELECT * FROM rekam_medis WHERE user_id = '$user_id'";
$result = mysqli_query($conn, $query);

// Cek apakah ada data rekam medis
if (mysqli_num_rows($result) == 0) {
    $rekam_medis = null;
} else {
    $rekam_medis = mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rekam Medis Pasien</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>

<header>
    <div class="logo">
        <img src="Images/LogoNumberOneHealth.png" alt="NumberOneHealth Logo" />
        <a href="#">Number<span>ONE</span>Health</a>
    </div>
    <nav class="navbar">
        <a href="#Home">Beranda</a>
        <a href="#Poli">Layanan Kami</a>
        <a href="#Dokter">Temukan Dokter</a>
        <a href="#Berita">Berita</a>
    </nav>
    <a href="logout.php" class="btn">Logout</a>
</header>

<section id="rekam-medis">
    <div class="rekam-medis-container">
        <h2>Rekam Medis Anda</h2>

        <?php if ($rekam_medis): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID Rekam Medis</th>
                        <th>Tanggal</th>
                        <th>Diagnosa</th>
                        <th>Perawatan</th>
                        <th>Dokter</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rekam_medis as $rekam): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($rekam['id']); ?></td>
                            <td><?php echo htmlspecialchars($rekam['tanggal']); ?></td>
                            <td><?php echo htmlspecialchars($rekam['diagnosa']); ?></td>
                            <td><?php echo htmlspecialchars($rekam['perawatan']); ?></td>
                            <td><?php echo htmlspecialchars($rekam['dokter']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="no-records">Anda belum memiliki rekam medis.</p>
        <?php endif; ?>

    </div>
</section>

</body>
</html>
