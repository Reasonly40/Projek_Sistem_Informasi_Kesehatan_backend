<?php
include('dbconn.php');

header('Content-Type: application/json');

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_GET['poli'])) {
        $poli = $_GET['poli'];
        $stmt = $pdo->prepare("SELECT id, name FROM dokter WHERE poli = :poli");
        $stmt->bindParam(':poli', $poli);
        $stmt->execute();
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
    } else {
        echo json_encode([]);
    }
} catch (PDOException $e) {
    error_log("Database Error: " . $e->getMessage());
    echo json_encode([]);
}
?>
