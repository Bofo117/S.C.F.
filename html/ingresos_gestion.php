<?php
require "../php/conexion.php";
$con = conecta();

// Lógica para eliminar un ingreso
if (isset($_GET['eliminar'])) {
    $folio = $_GET['eliminar'];

    // Eliminar el ingreso de la base de datos
    $sql = "DELETE FROM ingreso WHERE folio = :folio";
    $stmt = $con->prepare($sql);
    $stmt->bindParam(':folio', $folio);
    if ($stmt->execute()) {
        echo "<script>alert('Ingreso eliminado con éxito'); window.location.href='ingresos_gestion.php';</script>";
    } else {
        echo "<script>alert('Error al eliminar el ingreso');</script>";
    }
}

// Lógica para editar un ingreso
if (isset($_GET['editar'])) {
    $folio = $_GET['editar'];
    // Redirigir al formulario de edición
    header("Location: formulario_editar_ingreso.php?folio=" . $folio);
    exit();
}

// Consulta para obtener los datos de los ingresos
$sql = "SELECT * FROM ingreso";
$stmt = $con->prepare($sql);
$stmt->execute();
$ingresos = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/ingresos.css">
    <title>Gestión de Ingresos</title>
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
                            <a class="nav-link" href="../html/consultas.php">Consultar</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
    </header>

<div class="container mt-4">
    <h1 class="text-center">Gestión de Ingresos</h1>

    <!-- Tabla de Ingresos -->
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
                    <?php foreach ($ingresos as $ingreso): ?>
                        <tr>
                            <td><?= htmlspecialchars($ingreso['folio']) ?></td>
                            <td><?= htmlspecialchars($ingreso['categoria']) ?></td>
                            <td><?= htmlspecialchars($ingreso['cantidad_dinero']) ?></td>
                            <td><?= htmlspecialchars($ingreso['descripcion']) ?></td>
                            <td><?= htmlspecialchars($ingreso['cuenta']) ?></td>
                            <td><?= htmlspecialchars($ingreso['fecha']) ?></td>
                            <td>
                                <!-- Botones de Acción -->
                                <a href="ingresos_gestion.php?editar=<?= $ingreso['folio'] ?>" class="btn btn-warning btn-sm">Editar</a>
                                <a href="ingresos_gestion.php?eliminar=<?= $ingreso['folio'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro de eliminar este ingreso?')">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7">No se encontraron ingresos registrados</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Botón para Insertar Nuevo Ingreso -->
    <div class="text-center mt-4">
        <a href="formulario_alta_ingreso.php" class="btn btn-success">Registrar Nuevo Ingreso</a>
    </div>
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
