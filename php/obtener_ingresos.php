<?php
header('Content-Type: application/json');
include 'conexion.php';

try {
    $sql = "SELECT * FROM ingresos";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($result);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
