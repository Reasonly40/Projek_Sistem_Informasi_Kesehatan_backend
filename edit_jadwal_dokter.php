<?php
// Mulai sesi
session_start();

// Masukkan koneksi ke database
include('dbconn.php');

// Pesan untuk menampilkan hasil aksi (berhasil atau gagal)
$message = "";

// Ambil data dokter berdasarkan ID jika disediakan
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk mengambil data dokter
    $sql = "SELECT * FROM dokter WHERE id = '$id'";
    $result = $conn->query($sql);

    // Jika data ditemukan
    if ($result->num_rows > 0) {
        $doctor = $result->fetch_assoc();
    } else {
        $message = "Dokter tidak ditemukan!";
    }
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form
    $id = $_POST['id'];
    $name = $_POST['name'];
    $hari = $_POST['hari'];
    $jam = $_POST['jam'];
    $lokasi = $_POST['lokasi'];

    // Query untuk mengupdate data dokter
    $sql = "UPDATE dokter 
            SET name = '$name', hari = '$hari', jam = '$jam', Lokasi = '$lokasi' 
            WHERE id = '$id'";

    // Mengeksekusi query dan mengecek apakah berhasil
    if ($conn->query($sql) === TRUE) {
        $message = "Data dokter berhasil diperbarui!";
    } else {
        $message = "Terjadi kesalahan: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Dokter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 50%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        p {
            text-align: center;
            font-size: 16px;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-size: 16px;
            color: #333;
        }

        input[type="text"] {
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .btn-back {
            padding: 10px 20px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-align: center;
            margin-top: 20px;
            transition: background-color 0.3s;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }

        a {
            display: inline-block;
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
            color: #007BFF;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Data Dokter</h1>
    <?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>

    <!-- Form Edit Dokter -->
    <?php if (isset($doctor)): ?>
        <form action="edit_dokter.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $doctor['id']; ?>">
            
            <label for="name">Nama:</label>
            <input type="text" id="name" name="name" value="<?php echo $doctor['name']; ?>" required>

            <label for="hari">Hari:</label>
            <input type="text" id="hari" name="hari" value="<?php echo $doctor['hari']; ?>" required>

            <label for="jam">Jam:</label>
            <input type="text" id="jam" name="jam" value="<?php echo $doctor['jam']; ?>" required>

            <label for="lokasi">Lokasi:</label>
            <input type="text" id="lokasi" name="lokasi" value="<?php echo $doctor['Lokasi']; ?>" required>

            <button type="submit">Simpan Perubahan</button>
        </form>
    <?php else: ?>
        <p>Data dokter tidak tersedia untuk diedit.</p>
    <?php endif; ?>

    <!-- Tombol Kembali ke Beranda -->
    <a href="admin.php"><button class="btn-back">Kembali ke Beranda</button></a>
</div>
</body>
</html>

<?php
// Tutup koneksi
$conn->close();
?>