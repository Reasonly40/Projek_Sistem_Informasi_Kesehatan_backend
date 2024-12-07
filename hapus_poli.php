<?php
// Menghubungkan ke database
include 'dbconn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']); // Ambil ID poli dari parameter GET
        $query = "DELETE FROM poli WHERE id = ?"; // Ganti 'poli' dengan nama tabel jika berbeda
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            // Redirect ke halaman daftar poli setelah berhasil menghapus
            header("Location: data_poli.php?message=deleted");
            exit;
        } else {
            echo "Terjadi kesalahan: " . mysqli_error($conn);
        }
    } else {
        echo "ID tidak valid.";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Hapus Poli</title>
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

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin: 10px 0 5px;
            font-size: 16px;
            color: #333;
        }

        input[type="text"], input[type="email"], input[type="phone"], input[type="date"], input[type="time"], textarea {
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
    <script>
        function confirmDeletion(event) {
            event.preventDefault();
            if (confirm("Apakah Anda yakin ingin menghapus poli ini?")) {
                document.getElementById('delete-form').submit();
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Konfirmasi Hapus Poli</h1>
        <form id="delete-form" method="POST" action="delete_poli.php?id=<?= htmlspecialchars($_GET['id']) ?>">
            <button type="submit" name="confirm_delete" onclick="confirmDeletion(event)">Hapus</button>
        </form>
        <a href="admin.php" class="btn-back">Kembali ke Beranda</a>
    </div>
</body>
</html>
