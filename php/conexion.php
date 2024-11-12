<?php
// funciones/conecta.php
define("HOST", 'localhost');
define("BD", 'control_financiero');
define("USER_BD", 'postgres');
define("PASS_BD", '130115alan'); // Reemplaza con tu contraseña de PostgreSQL

function conecta() {
    try {
        // Conexión con PDO
        $dsn = "pgsql:host=" . HOST . ";dbname=" . BD;
        $con = new PDO($dsn, USER_BD, PASS_BD);
        // Configurar PDO para que lance excepciones en caso de error
        $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $con;
    } catch (PDOException $e) {
        die("Error de conexión: " . $e->getMessage());
    }
}

?>
