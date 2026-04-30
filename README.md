# 📋 Intranet Hub

> **⚠️ Estado: En Desarrollo**
>
> Este proyecto se encuentra en fase de desarrollo activo. Las funcionalidades están en construcción y pueden cambiar sin previo aviso.

## 🎯 ¿Qué es Intranet Hub?

Intranet Hub es una plataforma web completa para gestionar recursos humanos en empresas. Diseñada para que las organizaciones puedan controlar la jornada laboral de sus empleados, gestionar departamentos, solicitudes de vacaciones y proporciona un portal donde los empleados pueden acceder a información importante.

## ✨ Funcionalidades Principales

- **👥 Gestión de Empleados** - Registra y organiza tu equipo de trabajo
- **🏢 Departamentos** - Estructura organizacional flexible por departamentos
- **⏰ Control de Jornada Laboral** - Sistema de fichaje con entrada y salida
- **📅 Gestión de Vacaciones** - Los empleados pueden solicitar y ver sus vacaciones
- **💼 Portal del Empleado** - Acceso a nóminas, vacaciones, horarios y documentos
- **🏭 Multi-empresa** - Soporta múltiples empresas en una sola plataforma
- **🔔 Recordatorios** - Notificaciones automáticas para fichajes pendientes
- **📊 Reportes** - Visualización de datos de asistencia y recursos humanos

## 🚀 Requisitos Previos

Necesitarás tener instalado en tu computadora:

- **PHP** 8.2 o superior
- **Composer** (gestor de dependencias de PHP)
- **Node.js** y npm
- **MySQL** o **PostgreSQL**
- **Git**

## 📦 Cómo Instalar

### 1. Clona el repositorio

```bash
git clone https://github.com/tu-usuario/intranet-hub.git
cd intranet-hub
```

### 2. Instala las dependencias

```bash
composer install
npm install
```

### 3. Configura el proyecto

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Configura la base de datos en `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=intranet_hub
DB_USERNAME=root
DB_PASSWORD=
```

### 5. Ejecuta las migraciones

```bash
php artisan migrate
```

### 6. Inicia el servidor

```bash
php artisan serve
```

¡Listo! Tu aplicación estará en `http://localhost:8000`

## 🛠️ Tecnologías Utilizadas

- **Backend:** [Laravel](https://laravel.com) - Framework PHP moderno y potente
- **Panel de Control:** [Filament](https://filamentphp.com) - Panel elegante y rápido
- **Frontend:** [Livewire](https://livewire.laravel.com) + [Alpine.js](https://alpinejs.dev) - Interactividad sin salir de PHP
- **Base de Datos:** MySQL / PostgreSQL
- **Autenticación:** Laravel Sanctum

## 📁 Estructura del Proyecto

```
intranet-hub/
├── app/
│   ├── Models/           # Modelos de datos (Empleados, Departamentos, etc.)
│   ├── Filament/         # Recursos y páginas del panel
│   └── Http/             # Controladores y middleware
├── database/
│   ├── migrations/       # Cambios en la base de datos
│   └── seeders/          # Datos de prueba
├── routes/               # Rutas de la aplicación
├── resources/            # Vistas y archivos de estilo
└── tests/                # Pruebas automáticas
```

## 🚦 Estado de Desarrollo

Estas son las características que estamos desarrollando:

- ⏳ Módulo de departamentos
- ⏳ Control de jornada laboral (fichaje entrada/salida)
- ⏳ Gestión de vacaciones y solicitudes
- ⏳ Portal del empleado
- ⏳ Sistema de nóminas
- ⏳ Reportes y analítica avanzada
- ⏳ Sistema de notificaciones y recordatorios

## 🤝 ¿Encontraste un Error?

Si encuentras bugs o tienes sugerencias, por favor abre un [issue](https://github.com/tu-usuario/intranet-hub/issues).

## 📝 Licencia

Este proyecto está bajo la licencia [MIT](LICENSE).

## 👨‍💻 Autor

## Ismael Catalá - https://github.com/elrincondeisma

**Última actualización:** Abril 2026
