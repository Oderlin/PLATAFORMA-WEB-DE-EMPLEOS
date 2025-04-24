<?php
// Incluir configuración de base de datos
include '../includes/config.php';  // Asegúrate de ajustar la ruta según sea necesario

// Verificar si el usuario está logueado
if (!isset($_SESSION['usuario_id'])) {
    header("Location: login.php"); // Si no está logueado, redirigir a login
    exit();
}

// Obtener el ID del usuario logueado
$usuario_id = $_SESSION['usuario_id'];

// Depuración: Mostrar el usuario_id de la sesión
// echo "usuario_id: $usuario_id"; // Elimina esta línea después de depurar

// Obtener los datos del candidato desde la base de datos
$stmt = $pdo->prepare("SELECT * FROM candidatos WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);

// Depuración: Verificar si se encontró el candidato
$candidato = $stmt->fetch(PDO::FETCH_ASSOC);

// Verificación de los datos del candidato
if (!$candidato) {
    // Si no se encuentra el candidato, muestra el usuario_id y la consulta
    die("Candidato no encontrado. Usuario_id: $usuario_id");
}
?>

<?php include '../includes/header.php'; ?>

<div class="container">
    <h2>Perfil del Candidato</h2>

    <div class="profile-info">
        <p><strong>Nombre:</strong> <?php echo htmlspecialchars($candidato['nombre_completo']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($candidato['email']); ?></p>
        <p><strong>Teléfono:</strong> <?php echo htmlspecialchars($candidato['telefono']); ?></p>
        <p><strong>Ciudad:</strong> <?php echo htmlspecialchars($candidato['ciudad']); ?></p>
        <p><strong>Formación Académica:</strong> <?php echo nl2br(htmlspecialchars($candidato['formacion_academica'])); ?></p>
        <p><strong>Experiencia Laboral:</strong> <?php echo nl2br(htmlspecialchars($candidato['experiencia_laboral'])); ?></p>
        <p><strong>Habilidades:</strong> <?php echo nl2br(htmlspecialchars($candidato['habilidades'])); ?></p>
        <p><strong>Idiomas:</strong> <?php echo nl2br(htmlspecialchars($candidato['idiomas'])); ?></p>
        <p><strong>Objetivo Profesional:</strong> <?php echo nl2br(htmlspecialchars($candidato['objetivo_profesional'])); ?></p>
        <p><strong>Logros:</strong> <?php echo nl2br(htmlspecialchars($candidato['logros'])); ?></p>
        <p><strong>Disponibilidad:</strong> <?php echo htmlspecialchars($candidato['disponibilidad']); ?></p>
        
        <?php if ($candidato['foto'] && file_exists('../uploads/' . $candidato['foto'])): ?>
            <p><strong>Foto:</strong><br>
            <img src="<?php echo '../uploads/' . htmlspecialchars($candidato['foto']); ?>" alt="Foto de perfil" style="width:150px; height:auto;">
            </p>
        <?php endif; ?>

        <?php if ($candidato['cv_pdf'] && file_exists('../uploads/' . $candidato['cv_pdf'])): ?>
            <p><strong>CV en PDF:</strong><br>
            <a href="<?php echo '../uploads/' . htmlspecialchars($candidato['cv_pdf']); ?>" target="_blank">Ver CV</a>
            </p>
        <?php endif; ?>
    </div>

    <a href="editar_perfil.php" class="btn btn-primary">Editar Perfil</a>
</div>

<?php include '../includes/footer.php'; ?>