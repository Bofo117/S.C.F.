<?php
require "../php/conexion.php";
$con = conecta();

// Lógica para eliminar un gasto
if (isset($_GET['eliminar'])) {
    $folio = $_GET['eliminar'];
    
    // Eliminar el gasto de la base de datos
    $sql = "DELETE FROM gasto WHERE folio = :folio";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':folio', $folio);
    if ($stmt->execute()) {
        echo "<script>alert('Gasto eliminado con éxito'); window.location.href='gastos_gestion.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el gasto');</script>";
    }
}

// Lógica para editar un gasto
if (isset($_GET['editar'])) {
    $folio = $_GET['editar'];
    // Redirigir al formulario de edición
    header("Location: formulario_editar.php?folio=" . $folio);
    exit();
}

// Consulta para obtener los datos de los gastos
$sql = "SELECT * FROM gasto";
$stmt = $con->prepare($sql);
$stmt->execute();
$gastos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/gastos.css">
    <title>Gestión de Gastos</title>
</head>
<body>
<body>
<header>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand floating-brand" href="#">S.C.F</a>
                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="../html/index.html">Inicio</a></li>
                        <li class="nav-item"><a class="nav-link active" href="../html/ingresos_gestion.php">Ingresos</a></li>
                        <li class="nav-item"><a class="nav-link" href="../html/gastos_gestion.php">Gastos</a></li>
                        <li class="nav-item"><a class="nav-link" href="../html/cuentas.html">Cuentas</a></li>
                        <li class="nav-item"><a class="nav-link" href="../html/perfil.html">Perfil</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <h1 class="text-center">Gestión de Gastos</h1>

        <!-- Tabla de Gastos -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center">
                <thead class="table-light">
                    <tr>
                        <th>Folio</th>
                        <th>Nombre</th>
                        <th>Monto</th>
                        <th>Descripción</th>
                        <th>Cuenta</th>
                        <th>Fecha</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($gastos)): ?>
                        <?php foreach ($gastos as $gasto): ?>
                            <tr>
                                <td><?= htmlspecialchars($gasto['folio']) ?></td>
                                <td><?= htmlspecialchars($gasto['categoria']) ?></td>
                                <td><?= htmlspecialchars($gasto['cantidad_dinero']) ?></td>
                                <td><?= htmlspecialchars($gasto['descripcion']) ?></td>
                                <td><?= htmlspecialchars($gasto['cuenta']) ?></td>
                                <td><?= htmlspecialchars($gasto['fecha']) ?></td>
                                <td>
                                    <!-- Botones de Acción -->
                                    <a href="gastos_gestion.php?editar=<?= $gasto['folio'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                    <a href="gastos_gestion.php?eliminar=<?= $gasto['folio'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este gasto?')">Eliminar</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No se encontraron gastos registrados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Botón para Insertar Nuevo Gasto -->
        <div class="text-center mt-4">
            <a href="formulario_alta.php" class="btn btn-success">Registrar Nuevo Gasto</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
