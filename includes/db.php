<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'plataforma_de_empleos';  // Asegúrate de que este nombre coincida con el de tu base de datos
$username = 'root';  // Usuario predeterminado de MySQL en XAMPP
$password = '';  // Contraseña predeterminada en XAMPP

try {
    // Conexión a la base de datos usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Configurar el modo de error para mostrar excepciones
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Establecer el juego de caracteres para evitar problemas con caracteres especiales
    $pdo->exec("SET NAMES 'utf8'");
} catch (PDOException $e) {
    // Mostrar un mensaje si ocurre un error de conexión
    die("Error de conexión: " . $e->getMessage());
}
?>