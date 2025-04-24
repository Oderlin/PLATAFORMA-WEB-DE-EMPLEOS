<?php

// Incluir configuración de la base de datos
include '../includes/config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Verificar que los datos se están recibiendo correctamente
    echo "Correo recibido: " . htmlspecialchars($email) . "<br>";
    echo "Contraseña recibida: " . htmlspecialchars($password) . "<br>";

    try {
        // Verificar si el email existe en la base de datos
        $stmt = $pdo->prepare("SELECT id, password, tipo FROM usuarios WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar si el usuario fue encontrado
        if ($user) {
            echo "Usuario encontrado. ID: " . $user['id'] . "<br>"; // Depuración

            // Verificar la contraseña ingresada
            if (password_verify($password, $user['password'])) {
                echo "Contraseña correcta. Iniciando sesión...<br>"; // Depuración

                // Iniciar sesión y redirigir según el tipo de usuario
                $_SESSION['usuario_id'] = $user['id'];
                $_SESSION['tipo'] = $user['tipo'];

                // Verificar que la sesión se ha establecido correctamente
                echo "Sesión iniciada para el usuario con tipo: " . $_SESSION['tipo'] . "<br>";

                // Comprobamos la redirección a las páginas de perfil
                if ($user['tipo'] == 'candidato') {
                    echo "Redirigiendo a perfil_candidato.php<br>"; // Depuración
                    header("Location: perfil_candidato.php");
                    exit();
                } elseif ($user['tipo'] == 'empresa') {
                    echo "Redirigiendo a perfil_empresa.php<br>"; // Depuración
                    header("Location: perfil_empresa.php");
                    exit();
                }
            } else {
                $error = "Contraseña incorrecta.";
                echo $error; // Mostrar error si la contraseña es incorrecta
            }
        } else {
            $error = "El email no está registrado.";
            echo $error; // Mostrar error si el email no está registrado
        }
    } catch (PDOException $e) {
        $error = "Error al procesar la solicitud: " . $e->getMessage();
        echo $error; // Mostrar error de la base de datos
    }
}
?>

<?php include '../includes/header.php'; ?>

<div class="container">
    <h2>Iniciar sesión</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <form method="post" action="login.php">
        <div class="form-group">
            <label for="email">Correo electrónico</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        
        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Iniciar sesión</button>
        <p class="mt-3">¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </form>
</div>

<?php include '../includes/footer.php'; ?>