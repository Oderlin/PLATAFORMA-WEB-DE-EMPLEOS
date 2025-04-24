<?php 
include '../../includes/config.php';

// Verificar sesión de empresa
if (!isset($_SESSION['usuario_id']) || $_SESSION['tipo'] != 'empresa') {
    header("Location: login.php");
    exit();
}

// Obtener ID de la empresa
$empresa_id = null;
$stmt = $pdo->prepare("SELECT id FROM empresas WHERE usuario_id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
if ($stmt->rowCount() > 0) {
    $empresa = $stmt->fetch(PDO::FETCH_ASSOC);
    $empresa_id = $empresa['id'];
} else {
    header("Location: dashboard.php");
    exit();
}

// Procesar el formulario
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titulo = $_POST['titulo'];
    $descripcion = $_POST['descripcion'];
    $requisitos = $_POST['requisitos'];
    
    try {
        $stmt = $pdo->prepare("INSERT INTO ofertas (empresa_id, titulo, descripcion, requisitos) VALUES (?, ?, ?, ?)");
        $stmt->execute([$empresa_id, $titulo, $descripcion, $requisitos]);
        
        $mensaje = "Oferta publicada correctamente!";
    } catch (PDOException $e) {
        $error = "Error al publicar la oferta: " . $e->getMessage();
    }
}
?>

<?php include '../../includes/header.php'; ?>

<div class="container">
    <h2>Publicar Nueva Oferta de Empleo</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    
    <?php if (isset($mensaje)): ?>
        <div class="alert alert-success"><?php echo $mensaje; ?></div>
    <?php endif; ?>
    
    <form method="post">
        <div class="form-group">
            <label for="titulo">Título del Puesto</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        
        <div class="form-group">
            <label for="descripcion">Descripción del Puesto</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="5" required></textarea>
            <small class="form-text text-muted">Describe las responsabilidades del puesto.</small>
        </div>
        
        <div class="form-group">
            <label for="requisitos">Requisitos</label>
            <textarea class="form-control" id="requisitos" name="requisitos" rows="5" required></textarea>
            <small class="form-text text-muted">Lista los requisitos necesarios para el puesto.</small>
        </div>
        
        <button type="submit" class="btn btn-primary">Publicar Oferta</button>
        <a href="dashboard.php" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php include '../../includes/footer.php'; ?>