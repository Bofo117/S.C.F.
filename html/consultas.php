<?php
require "../php/conexion.php";
$con = conecta();

// Verifica si se ha enviado una fecha
if (isset($_POST['fecha'])) {
    $fecha = $_POST['fecha'];

    // Consulta para obtener ingresos de la fecha
    $sql_ingresos = "SELECT * FROM ingreso WHERE fecha = :fecha";
    $stmt_ingresos = $con->prepare($sql_ingresos);
    $stmt_ingresos->bindParam(':fecha', $fecha);
    $stmt_ingresos->execute();
    $ingresos = $stmt_ingresos->fetchAll(PDO::FETCH_ASSOC);

    // Consulta para obtener gastos de la fecha
    $sql_gastos = "SELECT * FROM gasto WHERE fecha = :fecha";
    $stmt_gastos = $con->prepare($sql_gastos);
    $stmt_gastos->bindParam(':fecha', $fecha);
    $stmt_gastos->execute();
    $gastos = $stmt_gastos->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Consulta de Ingresos y Gastos</title>
</head>
<body>
<header>
        <!-- Menu -->
        <nav class="navbar navbar-expand-lg menu">
            <div class="container-fluid menu">
                <a class="navbar-brand floating-brand" href="#">S.C.F</a>

                <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="../html/index.html">Inicio</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="../html/ingresos_gestion.php">Ingresos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../html/gastos_gestion.php">Gastos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../html/consultas.php">Consultar</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

    <div class="container mt-4">
        <h1 class="text-center">Consultar Ingresos y Gastos por Fecha</h1>

        <!-- Formulario para ingresar la fecha -->
        <form method="POST">
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" required>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Consultar</button>
            </div>
        </form>

        <?php if (isset($fecha)): ?>
            <h2 class="mt-4">Resultados para la fecha: <?= htmlspecialchars($fecha) ?></h2>

            <!-- Ingresos -->
            <h3>Ingresos</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Folio</th>
                            <th>Categoria</th>
                            <th>Monto</th>
                            <th>Descripción</th>
                            <th>Cuenta</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($ingresos)): ?>
                            <?php foreach ($ingresos as $ingreso): ?>
                                <tr>
                                    <td><?= htmlspecialchars($ingreso['folio']) ?></td>
                                    <td><?= htmlspecialchars($ingreso['categoria']) ?></td>
                                    <td><?= htmlspecialchars($ingreso['cantidad_dinero']) ?></td>
                                    <td><?= htmlspecialchars($ingreso['descripcion']) ?></td>
                                    <td><?= htmlspecialchars($ingreso['cuenta']) ?></td>
                                    <td><?= htmlspecialchars($ingreso['fecha']) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No se encontraron ingresos para esta fecha</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Gastos -->
            <h3>Gastos</h3>
            <div class="table-responsive">
                <table class="table table-bordered table-striped text-center">
                    <thead class="table-light">
                        <tr>
                            <th>Folio</th>
                            <th>Categoria</th>
                            <th>Monto</th>
                            <th>Descripción</th>
                            <th>Cuenta</th>
                            <th>Fecha</th>
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
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No se encontraron gastos para esta fecha</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
