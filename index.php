<?php
// Configuración inicial
require_once __DIR__.'/includes/config.php';

// Consulta las últimas ofertas activas
try {
    $stmt = $pdo->query("SELECT o.*, e.nombre_empresa 
                        FROM ofertas o 
                        JOIN empresas e ON o.empresa_id = e.id 
                        WHERE o.estado = 'activa' 
                        ORDER BY o.fecha_publicacion DESC 
                        LIMIT 3");
    $ofertas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    $error_ofertas = "Error al cargar ofertas: " . $e->getMessage();
}

// Cabecera
include __DIR__.'/includes/header.php';
?>

<main class="container">
    <section class="hero-section text-center py-5 bg-light mb-5 rounded">
        <h1 class="display-4">Bienvenido a la Plataforma de Empleos</h1>
        <p class="lead">Conectando talento con oportunidades</p>
    </section>

    <div class="row g-4">
        <!-- Panel Candidatos -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="feature-icon bg-primary bg-gradient mb-4">
                        <i class="bi bi-person-badge fs-1 text-white"></i>
                    </div>
                    <h2 class="card-title h4">¿Buscas trabajo?</h2>
                    <p class="card-text">Regístrate como candidato y accede a cientos de oportunidades laborales.</p>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="<?= BASE_URL ?>candidatos/registro.php" class="btn btn-primary px-4">Registro</a>
                        <a href="<?= BASE_URL ?>candidatos/login.php" class="btn btn-outline-primary px-4">Iniciar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Panel Empresas -->
        <div class="col-lg-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body p-4 text-center">
                    <div class="feature-icon bg-success bg-gradient mb-4">
                        <i class="bi bi-building fs-1 text-white"></i>
                    </div>
                    <h2 class="card-title h4">¿Eres una empresa?</h2>
                    <p class="card-text">Publica tus vacantes y encuentra al mejor talento para tu organización.</p>
                    <div class="d-grid gap-2 d-md-block">
                        <a href="<?= BASE_URL ?>empresas/registro.php" class="btn btn-success px-4">Registro</a>
                        <a href="<?= BASE_URL ?>empresas/login.php" class="btn btn-outline-success px-4">Iniciar Sesión</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Últimas Ofertas -->
    <section class="latest-jobs mt-5 pt-4">
        <h2 class="text-center mb-4">Últimas Ofertas Publicadas</h2>
        
        <?php if (!empty($error_ofertas)): ?>
            <div class="alert alert-danger"><?= $error_ofertas ?></div>
        <?php endif; ?>
        
        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php if (!empty($ofertas)): ?>
                <?php foreach ($ofertas as $oferta): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-body">
                                <h3 class="card-title h5"><?= htmlspecialchars($oferta['titulo']) ?></h3>
                                <h4 class="card-subtitle mb-2 text-muted small"><?= htmlspecialchars($oferta['nombre_empresa']) ?></h4>
                                <p class="card-text"><?= substr(htmlspecialchars($oferta['descripcion']), 0, 120) ?>...</p>
                            </div>
                            <div class="card-footer bg-transparent">
                                <a href="#" class="btn btn-sm btn-outline-primary stretched-link">Ver Detalles</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">Actualmente no hay ofertas disponibles. Vuelve a consultar más tarde.</div>
                </div>
            <?php endif; ?>
        </div>
    </section>
</main>

<?php
// Pie de página
include __DIR__.'/includes/footer.php';
?>