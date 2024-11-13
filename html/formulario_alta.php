<?php
require "../php/conexion.php";
$con = conecta();

// Lógica para insertar un nuevo gasto
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $categoria = $_POST['categoria'];
    $cantidad_dinero = $_POST['cantidad_dinero'];
    $descripcion = $_POST['descripcion'];
    $cuenta = $_POST['cuenta'];
    $fecha = $_POST['fecha'];

    // Consulta para insertar el gasto sin especificar el folio
    $sql = "INSERT INTO gasto (categoria, cantidad_dinero, descripcion, cuenta, fecha) VALUES (:categoria, :cantidad_dinero, :descripcion, :cuenta, :fecha)";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':cantidad_dinero', $cantidad_dinero);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':cuenta', $cuenta);
    $stmt->bindParam(':fecha', $fecha);

    if ($stmt->execute()) {
        echo "<script>alert('Gasto registrado con éxito'); window.location.href='gastos_gestion.php';</script>";
    } else {
        echo "<script>alert('Error al registrar el gasto');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Registrar Nuevo Gasto</title>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Registrar Nuevo Gasto</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" id="categoria" name="categoria" required>
            </div>

            <div class="mb-3">
                <label for="cantidad_dinero" class="form-label">Monto</label>
                <input type="number" class="form-control" id="cantidad_dinero" name="cantidad_dinero" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
            </div>

            <div class="mb-3">
                <label for="cuenta" class="form-label">Cuenta</label>
                <input type="text" class="form-control" id="cuenta" name="cuenta" required>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Registrar</button>
                <a href="gastos_gestion.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
