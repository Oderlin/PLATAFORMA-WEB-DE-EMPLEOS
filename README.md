# Plataforma Web de Empleos

Este proyecto es una **plataforma web de empleos** desarrollada en PHP y MySQL. Permite a los candidatos registrar sus perfiles profesionales y a las empresas acceder a ellos para posibles contrataciones.

## Tecnologías utilizadas

- **PHP 8.2**
- **MySQL**
- **Bootstrap 5**
- **HTML5 / CSS3**
- **XAMPP (servidor local)**
- **Chart.js (para estadísticas, opcional)**

## Funcionalidades principales

### Para candidatos:
- Registro de cuenta y login seguro.
- Creación y edición de perfil profesional (nombre, email, teléfono, ciudad, formación, experiencia, habilidades, idiomas, objetivos, logros, disponibilidad).
- Subida de foto de perfil y CV en PDF.
- Visualización del perfil en una vista dedicada.

### Para empresas:
- Registro de cuenta y login seguro.
- Acceso a perfiles de candidatos (próxima funcionalidad).

## Estructura del proyecto

```
Proyecto Final Web Plataforma de Empleos
├── includes
│   ├── config.php
│   ├── db.php
│   ├── header.php
│   └── footer.php
├── candidatos
│   ├── perfil_candidato.php
│   └── editar_perfil.php
├── empresa
│   └── perfil_empresa.php
├── uploads
│   └── (archivos subidos por los usuarios)
├── login.php
├── logout.php
└── registro.php
```

## Instalación local

1. Clona este repositorio:
   ```bash
   git clone https://github.com/tuusuario/plataforma-web-empleos.git
   ```
2. Coloca la carpeta dentro de `htdocs` si usas XAMPP.
3. Importa la base de datos `plataforma_empleos.sql` desde phpMyAdmin.
4. Inicia Apache y MySQL desde XAMPP.
5. Abre en tu navegador:
   ```
   http://localhost/Proyecto%20Final%20Web%20Plataforma%20de%20Empleos/
   ```

##  Accesos de prueba

Puedes agregar usuarios directamente a la base de datos o registrarte desde el formulario de registro.

## Mejoras futuras

- Panel administrativo para validar registros.
- Buscador de perfiles por palabras clave.
- Sistema de mensajería entre candidatos y empresas.
- Notificaciones por correo electrónico.

## Autor

**Oderlin Sanchez Santana**
**Nicole Alexandra Ortiz castillo**
