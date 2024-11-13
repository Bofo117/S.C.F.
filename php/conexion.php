<?php
// funciones/conecta.php
define("HOST", 'localhost');
define("BD", 'control_financiero');
define("USER_BD", 'postgres');
define("PASS_BD", '130115alan'); // Reemplaza con tu contraseña de PostgreSQL

function conecta() {
    try {
        // Conexión con PDO para PostgreSQL
        $dsn = "pgsql:host=" . HOST . ";port=5432;dbname=" . BD;
        $con = new PDO($dsn, USER_BD, PASS_BD);
        // Configurar PDO para que lance excepciones en caso de error
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Configurar PDO para devolver los resultados como arreglos asociativos
        $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $con;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}
?>
