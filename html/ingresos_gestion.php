<?php
require "../php/conexion.php";
$con = conecta();

// Consulta para obtener datos de la tabla 'ingreso'
$sql = "SELECT * FROM ingreso WHERE uid = 12345";
$stmt = $con->prepare($sql);
$stmt->execute();
$ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/ingresos.css">
    <title>My Profit Helper</title>
</head>

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

    <br>

    <div class="container">
        <h1 class="text-center">Gestión de Ingresos</h1>
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
                    <?php if (!empty($ingresos)): ?>
                        <?php foreach ($ingresos as $row): ?>
                            <tr>
                                <td><?= htmlspecialchars($row['folio']) ?></td>
                                <td><?= htmlspecialchars($row['categoria']) ?></td>
                                <td><?= htmlspecialchars($row['cantidad_dinero']) ?></td>
                                <td><?= htmlspecialchars($row['descripcion']) ?></td>
                                <td><?= htmlspecialchars($row['cuenta']) ?></td>
                                <td><?= htmlspecialchars($row['fecha']) ?></td>
                                <td>HOLA</td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7">No se encontraron resultados</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
