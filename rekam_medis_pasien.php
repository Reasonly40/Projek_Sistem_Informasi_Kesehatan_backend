<?php
// Mulai session di awal halaman
session_start();

// Include koneksi ke database
include('dbconn.php');

// Ambil user_id dari session
$user_id = $_SESSION['id'];
$role = $_SESSION['role'];

// Cek apakah session user_id ada, jika tidak, alihkan ke halaman login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

// Cek apakah user memiliki role yang benar
if ($_SESSION['role'] != 'user') {
    header("Location: login.php");
    exit;
}

// Ambil data rekam medis pasien berdasarkan user_id
$query = "
    SELECT 
        rekam_medis.id, 
        rekam_medis.updated_at, 
        rekam_medis.diagnosis, 
        poli.nama_poli, 
        dokter.nama AS nama_dokter
    FROM rekam_medis
    JOIN poli ON rekam_medis.poli_id = poli.id
    JOIN dokter ON rekam_medis.dokter_id = dokter.id
    WHERE rekam_medis.user_id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Cek apakah ada data rekam medis
$rekam_medis = ($result->num_rows > 0) ? $result->fetch_all(MYSQLI_ASSOC) : null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Rekam Medis Pasien</title>
    <link rel="stylesheet" href="style.css" />
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .rekam-medis-container {
            max-width: 1200px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table thead {
            background-color: #007BFF;
            color: white;
        }

        table thead th {
            padding: 10px;
            text-align: left;
        }

        table tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tbody tr:hover {
            background-color: #f1f1f1;
        }

        table tbody td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        .no-records {
            text-align: center;
            color: #888;
            font-size: 18px;
            margin: 20px 0;
        }
    </style>
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
                            <td><?php echo htmlspecialchars($rekam['updated_at']); ?></td>
                            <td><?php echo htmlspecialchars($rekam['diagnosis']); ?></td>
                            <td><?php echo htmlspecialchars($rekam['nama_poli']); ?></td>
                            <td><?php echo htmlspecialchars($rekam['nama_dokter']); ?></td>
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