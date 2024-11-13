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
    <style>
        /* General */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    position: relative;
    overflow-x: hidden;
}
/* Figuras de fondo */
body::before, body::after {
    content: "";
    position: absolute;
    border-radius: 50%;
    z-index: -1;
}

body::before {
    width: 300px;
    height: 300px;
    background-color: #1c74e9;
    top: -50px;
    left: -100px;
}

header::before, footer::before {
    content: "";
    position: absolute;
    border-radius: 50%;
    z-index: -1;
}

header::before {
    width: 250px;
    height: 250px;
    background-color: #3b4f69;
    top: 0;
    left: -120px;
}

/* Navbar */
.navbar {
    background-color: #dee2e6;
    position: relative;
    z-index: 1;
}

.navbar-brand {
    font-weight: bold;
    font-size: 24px;
}

.navbar-nav .nav-link {
    color: #6c757d;
    font-size: 18px;
    padding: 10px 20px;
}

.navbar-nav .nav-link.active {
    font-weight: bold;
    color: #000;
}

/* Header */
h1 {
    font-size: 48px;
    font-weight: bold;
    color: #333;
}

/* Menu */
.menu {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #c0c5c9;
}

/* Footer */
footer {
    background-color: #343a40;
    padding: 40px 0;
    color: #fff;
}

footer h5 {
    font-size: 20px;
    font-weight: bold;
}

footer a {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
    transition: color 0.3s;
}

footer a:hover {
    color: #1c74e9;
}

footer .container {
    max-width: 1200px;
}

footer .row {
    margin-bottom: 30px;
}

footer .col-md-4 {
    margin-bottom: 30px;
}

footer .bi {
    font-size: 24px;
    transition: color 0.3s;
}

footer .bi:hover {
    color: #1c74e9;
}

footer .text-center {
    margin-top: 20px;
}

footer .text-center p {
    font-size: 16px;
}

    </style>
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
                            <a class="nav-link active" href="../html/consultas.php">Consultar</a>
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
<footer class="footer mt-5">
    <div class="container">
        <div class="row text-center text-light">
            <div class="col-md-4">
                <h5 class="mb-3">S.C.F</h5>
                <p>Todos los derechos reservados &copy; 2024</p>
            </div>
            <div class="col-md-4">
                <h5 class="mb-3">Enlaces Rápidos</h5>
                <ul class="list-unstyled">
                    <li><a href="../html/index.html" class="text-light">Inicio</a></li>
                    <li><a href="../html/ingresos_gestion.php" class="text-light">Gestión de Ingresos</a></li>
                    <li><a href="../html/gastos_gestion.php" class="text-light">Gestión de Gastos</a></li>
                    <li><a href="../html/consultas.php" class="text-light">Consultar</a></li>
                </ul>
            </div>
            <div class="col-md-4">
                <h5 class="mb-3">Contacto</h5>
                <p><i class="bi bi-envelope"></i> contacto@scf.com</p>
                <p><i class="bi bi-telephone"></i> +1 800 123 4567</p>
            </div>
        </div>
        <div class="row">
            <div class="col text-center">
                <p class="mt-3 mb-0">Síguenos en nuestras redes sociales:</p>
                <a href="#" class="text-light me-3"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-twitter"></i></a>
                <a href="#" class="text-light me-3"><i class="bi bi-instagram"></i></a>
            </div>
        </div>
    </div>
</footer>
</html>
