<?php
require "../php/conexion.php";
$con = conecta();

// Lógica para editar un gasto
if (isset($_GET['folio'])) {
    $folio = $_GET['folio'];

    // Consultar el gasto a editar
    $sql = "SELECT * FROM gasto WHERE folio = :folio";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':folio', $folio);
    $stmt->execute();
    $gasto = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Obtener datos del formulario
    $categoria = $_POST['categoria'];
    $cantidad_dinero = $_POST['cantidad_dinero'];
    $descripcion = $_POST['descripcion'];
    $cuenta = $_POST['cuenta'];
    $fecha = $_POST['fecha'];

    // Actualizar el gasto en la base de datos
    $sql = "UPDATE gasto SET categoria = :categoria, cantidad_dinero = :cantidad_dinero, descripcion = :descripcion, cuenta = :cuenta, fecha = :fecha WHERE folio = :folio";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':categoria', $categoria);
    $stmt->bindParam(':cantidad_dinero', $cantidad_dinero);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':cuenta', $cuenta);
    $stmt->bindParam(':fecha', $fecha);
    $stmt->bindParam(':folio', $folio);

    if ($stmt->execute()) {
        echo "<script>alert('Gasto actualizado con éxito'); window.location.href='gastos_gestion.php';</script>";
    } else {
        echo "<script>alert('Error al actualizar el gasto');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Editar Gasto</title>
</head>
<body>
    <div class="container mt-4">
        <h1 class="text-center">Editar Gasto</h1>

        <form method="POST">
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <input type="text" class="form-control" id="categoria" name="categoria" value="<?= htmlspecialchars($gasto['categoria']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="cantidad_dinero" class="form-label">Monto</label>
                <input type="number" class="form-control" id="cantidad_dinero" name="cantidad_dinero" value="<?= htmlspecialchars($gasto['cantidad_dinero']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" id="descripcion" name="descripcion" required><?= htmlspecialchars($gasto['descripcion']) ?></textarea>
            </div>

            <div class="mb-3">
                <label for="cuenta" class="form-label">Cuenta</label>
                <input type="text" class="form-control" id="cuenta" name="cuenta" value="<?= htmlspecialchars($gasto['cuenta']) ?>" required>
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="<?= htmlspecialchars($gasto['fecha']) ?>" required>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Actualizar</button>
                <a href="gastos_gestion.php" class="btn btn-danger">Cancelar</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
