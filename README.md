# 🧩 Desafío Quinttos – Gestión de Tareas Personales

## 📘 Descripción
Proyecto realizado como parte del desafío técnico PHP SSR de Quinttos.

Este proyecto es una aplicación web desarrollada en **Laravel** que permite gestionar tareas personales.  
Incluye autenticación de administrador, CRUD completo de tareas, filtros por estado o título y un panel de estadísticas.  

---

## ⚙️ Requisitos

Para ejecutar el proyecto se necesita:

- **PHP 8.2+**
- **Composer**
- **MySQL 8+**
- **Laravel 11** (instalado mediante Composer)

---

## 🚀 Instalación

### 1. Clonar el repositorio

```bash

git clone git@github.com:dani-diaz-dev/desafio-quinttos.git
cd desafio-quinttos
```

### 2. Instalar dependencias PHP
```bash

composer install
```

### 3. Configurar entorno
```bash

cp .env.example .env
php artisan key:generate
```
Editar el archivo `.env` con los valores adecuados para la base de datos, cache, mail, etc. 
Ejemplo:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=desafio_quinttos
DB_USERNAME=root
DB_PASSWORD=
```
### 4. Migraciones y seeders
Esto creará las tablas necesarias y cargará los datos iniciales (por ejemplo, el usuario administrador).
```bash

php artisan migrate --seed
```
### 5. Levantar servidor local
```bash

php artisan serve
```
---
## 🔐 Credenciales de admin
Por defecto, el seeder cargará un usuario con rol administrador.

| Usuario                                       | Contraseña |
| --------------------------------------------- | ---------- |
| admin@admin.com| admin123   |
---
## 🔧 Comandos útiles en Laravel

`php artisan serve` — Inicia el servidor de desarrollo

`php artisan migrate:fresh --seed` — Elimina todas las tablas, vuelve a crear y carga datos seed

`php artisan route:list` — Muestra todas las rutas definidas

`php artisan optimize:clear` — Limpia cachés de configuración/rutas/vistas

---
## Testing local

Se han creado test de cobertura para las entidades principales del proyecto. 
Para ejecutar los tests utilizar el siguiente comando:
```bash

php artisan test
```
