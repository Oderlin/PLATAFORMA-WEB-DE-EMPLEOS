<?php
session_start();

// Constantes de ruta
define('ROOT_PATH', dirname(__DIR__)); // Sube desde /includes a la raíz del proyecto
define('BASE_URL', 'http://localhost/Proyecto%20Final%20Web%20Plataforma%20de%20Empleos/');

// Incluir db.php (que está en la misma carpeta que este archivo)
require_once __DIR__ . '/db.php'; // Asegúrate de que la ruta sea correcta
?>