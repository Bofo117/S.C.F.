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
<style>
    /* General */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f9;
    margin: 0;
    padding: 0;
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

/* Formulario y campos */
.form-container {
    max-width: 900px;
    margin: 50px auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.form-container input,
.form-container select,
.form-container textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
}

.form-container input:focus,
.form-container select:focus,
.form-container textarea:focus {
    border-color: #1c74e9;
    outline: none;
}

.form-container button {
    padding: 12px 30px;
    background-color: #1c74e9;
    color: #fff;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
}

.form-container button:hover {
    background-color: #1458b0;
}

/* Footer */
footer.footer-alt-editar {
    background-color: #2c3e50;
    padding: 40px 0;
    color: #fff;
}

footer.footer-alt-editar h5 {
    font-size: 22px;
    font-weight: bold;
    margin-bottom: 15px;
}

footer.footer-alt-editar a {
    text-decoration: none;
    color: #fff;
    font-size: 16px;
    transition: color 0.3s;
}

footer.footer-alt-editar a:hover {
    color: #1c74e9;
}

footer.footer-alt-editar .container {
    max-width: 1200px;
}

footer.footer-alt-editar .row {
    margin-bottom: 30px;
}

footer.footer-alt-editar .col-md-4 {
    margin-bottom: 30px;
}

footer.footer-alt-editar .bi {
    font-size: 24px;
    transition: color 0.3s;
}

footer.footer-alt-editar .bi:hover {
    color: #1c74e9;
}

footer.footer-alt-editar .text-center {
    margin-top: 20px;
}

footer.footer-alt-editar .text-center p {
    font-size: 16px;
}

footer.footer-alt-editar .text-center a {
    margin-right: 10px;
}

/* Estilo para botones comunes */
button.btn-primary {
    background-color: #1c74e9;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 5px;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s;
}

button.btn-primary:hover {
    background-color: #1458b0;
}

/* Estilo para tablas */
.table-responsive {
    margin-top: 30px;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table th, table td {
    padding: 12px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

table th {
    background-color: #f8f9fa;
    font-weight: bold;
}

table tr:hover {
    background-color: #f1f1f1;
}

/* Menú */
.menu {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: #c0c5c9;
    padding: 20px 0;
}

.menu a {
    color: #333;
    font-size: 18px;
    padding: 10px 20px;
    text-decoration: none;
}

.menu a:hover {
    color: #1c74e9;
    background-color: #ddd;
}

/* Ajustes para dispositivos pequeños */
@media (max-width: 768px) {
    .navbar-brand {
        font-size: 20px;
    }

    .form-container {
        padding: 15px;
    }

    .menu a {
        font-size: 16px;
    }
}

</style>
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
<!-- Footer para Altas y Editar -->
<footer class="footer-alt-editar mt-5">
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

<!-- Agregar los iconos de Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.js"></script>

</html>
