<?php
// Incluir el archivo de configuración
include '../includes/config.php';
?>

<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    
    try {
        // Verificar si el email ya existe
        $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->rowCount() > 0) {
            $error = "El email ya está registrado.";
        } else {
            // Insertar nuevo usuario
            $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, email, password, tipo) VALUES (?, ?, ?, 'candidato')");
            $stmt->execute([$nombre, $email, $password]);
            
            $usuario_id = $pdo->lastInsertId();
            
            // Redirigir al perfil
            $_SESSION['usuario_id'] = $usuario_id;
            $_SESSION['tipo'] = 'candidato';
            header("Location: perfil.php");
            exit();
        }
    } catch (PDOException $e) {
        $error = "Error al registrar: " . $e->getMessage();
    }
}
?>

<?php
// Incluir el encabezado
include '../includes/header.php';
?>

<div class="container">
    <h2>Registro de Candidatos</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label for="nombre">Nombre completo</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrarse</button>
        <p class="mt-3">¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </form>
</div>

<?php
// Incluir el pie de página
include '../includes/footer.php';
?>