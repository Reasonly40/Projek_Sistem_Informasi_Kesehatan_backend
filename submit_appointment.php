<?php
// Aktifkan debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mulai sesi
session_start();

// Include koneksi database
include('dbconn.php');

header('Content-Type: application/json');

try {
    // Koneksi ke database
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Ambil data dari form (pastikan nama input sesuai dengan form Anda)
    $user_id = $_POST['user_id']; // ID pengguna
    $service = $_POST['service']; // Layanan yang dipilih
    $doctor = $_POST['doctor']; // Dokter yang dipilih

    // Query untuk menyisipkan data ke tabel appointments
    $query = "INSERT INTO appointments (user_id, service, doctor) VALUES (:user_id, :service, :doctor)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([
        ':user_id' => $user_id,
        ':service' => $service,
        ':doctor' => $doctor
    ]);

    // Periksa apakah form dikirimkan dengan metode POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Ambil data dari session
        if (isset($_SESSION['id'], $_SESSION['email'])) {
            $user_id = $_SESSION['id'];
            $patient_name = $_SESSION['name'] ?? 'Anonymous';
            $email = $_SESSION['email'];
        } else {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Silakan login terlebih dahulu.']);
            exit();
        }

        // Ambil data dari form
        $phone = $_POST['phone'] ?? null;
        $poli = $_POST['poli'] ?? null;
        $doctor = $_POST['doctor_name'] ?? null;
        $date = $_POST['appointment_date'] ?? null;
        $time = $_POST['appointment_time'] ?? null;
        $notes = $_POST['notes'] ?? '';

        // Validasi input
        if (!$phone || !$poli || !$doctor || !$date || !$time) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Semua data harus diisi.']);
            exit();
        }

        // Persiapkan query SQL
        $sql = "INSERT INTO appointments (user_id, patient_name, poli, doctor_name, appointment_date, appointment_time, notes) 
                VALUES (:user_id, :patient_name, :poli, :doctor_name, :date, :time, :notes)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':patient_name', $patient_name);
        $stmt->bindParam(':poli', $poli);
        $stmt->bindParam(':doctor_name', $doctor);
        $stmt->bindParam(':appointment_date', $date);
        $stmt->bindParam(':time', $time);
        $stmt->bindParam(':notes', $notes);

        // Eksekusi query
        if ($stmt->execute()) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Janji temu berhasil dibuat.']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Gagal membuat janji temu.']);
        }
    } else {
        http_response_code(405);
        echo json_encode(['status' => 'error', 'message' => 'Metode HTTP tidak diizinkan.']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Kesalahan pada server: ' . $e->getMessage()]);
}
?>
