<?php
session_start();
include('dbconn.php');

$message = "";

// Ambil data berita berdasarkan ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM berita WHERE id = '$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $berita = $result->fetch_assoc();
    } else {
        $message = "Berita tidak ditemukan!";
    }
}

// Proses jika form disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $judul = $_POST['judul'];
    $konten = $_POST['konten'];

    $sql = "UPDATE berita SET judul = '$judul', konten = '$konten' WHERE id = '$id'";

    if ($conn->query($sql) === TRUE) {
        $message = "Berita berhasil diperbarui!";
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
    <title>Edit Berita</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 0; }
        .container { width: 50%; margin: 50px auto; background-color: #fff; padding: 20px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); border-radius: 8px; }
        h1 { text-align: center; color: #333; margin-bottom: 20px; }
        form { display: flex; flex-direction: column; }
        label { margin: 10px 0 5px; font-size: 16px; color: #333; }
        input[type="text"], textarea { padding: 8px; font-size: 14px; border: 1px solid #ddd; border-radius: 4px; margin-bottom: 15px; }
        button { padding: 10px; background-color: #4CAF50; color: white; font-size: 16px; border: none; border-radius: 4px; cursor: pointer; transition: background-color 0.3s; }
        button:hover { background-color: #45a049; }
        .btn-back { padding: 10px 20px; background-color: #007BFF; color: white; border: none; border-radius: 4px; cursor: pointer; text-align: center; margin-top: 20px; }
        .btn-back:hover { background-color: #0056b3; }
    </style>
</head>
<body>
<div class="container">
    <h1>Edit Berita</h1>
    <?php if (isset($message)) echo "<p style='color: green;'>$message</p>"; ?>

    <?php if (isset($berita)): ?>
        <form action="edit_berita.php?id=<?php echo $berita['id']; ?>" method="POST">
            <label for="judul">Judul:</label>
            <input type="text" id="judul" name="judul" value="<?php echo $berita['judul']; ?>" required>

            <label for="konten">Konten:</label>
            <textarea id="konten" name="konten" required><?php echo $berita['konten']; ?></textarea>

            <button type="submit">Perbarui Berita</button>
        </form>
    <?php else: ?>
        <p>Berita tidak ditemukan untuk diedit.</p>
    <?php endif; ?>

    <a href="admin.php"><button class="btn-back">Kembali ke Beranda</button></a>
</div>
</body>
</html>

<?php $conn->close(); ?>
