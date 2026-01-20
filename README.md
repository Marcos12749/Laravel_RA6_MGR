# Sistema de Gestión de Usuarios y Publicaciones - Laravel

Proyecto Laravel básico que gestiona usuarios y publicaciones con datos de prueba generados automáticamente.

## 📋 Características

- **Gestión de Usuarios**: Sistema completo con roles (admin/user), estados activos/inactivos
- **Gestión de Publicaciones**: Sistema de posts vinculados a usuarios con categorías y estados
- **Factories Personalizadas**: Generación automatizada de datos realistas con Faker
- **Seeders Configurables**: Población automática de la base de datos con datos de prueba
- **Testing Ready**: Entorno preparado para regenerar datos de prueba con un solo comando

## 🗃️ Estructura de la Base de Datos

### Tabla Users

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | Identificador único |
| name | string | Nombre completo del usuario |
| username | string | Nombre de usuario único |
| role | string | Rol del usuario (admin/user) |
| active | boolean | Estado del usuario |
| email | string | Correo electrónico único |
| email_verified_at | timestamp | Fecha de verificación del email |
| password | string | Contraseña cifrada |
| remember_token | string | Token de sesión |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

### Tabla Posts

| Campo | Tipo | Descripción |
|-------|------|-------------|
| id | bigint | Identificador único |
| user_id | bigint | Usuario autor (clave foránea) |
| title | string | Título de la publicación |
| content | text | Contenido de la publicación |
| excerpt | string | Extracto/resumen |
| views | integer | Número de visualizaciones |
| category | string | Categoría de la publicación |
| published_at | timestamp | Fecha de publicación |
| is_published | boolean | Indica si está publicada |
| created_at | timestamp | Fecha de creación |
| updated_at | timestamp | Fecha de actualización |

## 🚀 Instalación

### Requisitos Previos

- PHP >= 8.2
- Composer
- MySQL/MariaDB
- XAMPP (opcional)

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone <url-repositorio>
cd Laravel_RA6_MGR
```

2. **Instalar dependencias**
```bash
composer install
```

3. **Configurar el archivo de entorno**
```bash
cp .env.example .env
```

4. **Editar .env** y configurar la base de datos:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_ra6_mgr
DB_USERNAME=root
DB_PASSWORD=
```

5. **Generar la clave de aplicación**
```bash
php artisan key:generate
```

6. **Crear la base de datos**
Crear la base de datos `laravel_ra6_mgr` en MySQL:
```sql
CREATE DATABASE laravel_ra6_mgr CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

7. **Ejecutar migraciones y seeders**
```bash
php artisan migrate:fresh --seed
```

## 🔄 Comandos Útiles

### Regenerar Base de Datos con Datos de Prueba
```bash
php artisan migrate:fresh --seed
```
Este comando elimina todas las tablas, las vuelve a crear y genera datos de prueba automáticamente.

### Solo Ejecutar Seeders
```bash
php artisan db:seed
```

### Ejecutar un Seeder Específico
```bash
php artisan db:seed --class=DatabaseSeeder
```

### Crear Usuarios y Posts Manualmente con Tinker
```bash
php artisan tinker
```

Luego dentro de Tinker:
```php
// Crear un usuario con 5 posts
User::factory()->has(Post::factory(5))->create();

// Crear un admin con posts publicados
User::factory()->admin()->has(Post::factory(3)->published())->create();

// Crear solo posts para un usuario existente
Post::factory(5)->create(['user_id' => 1]);
```

## 📊 Datos Generados

El seeder `DatabaseSeeder` genera automáticamente:

- **7 usuarios totales**:
  - 5 usuarios aleatorios con roles y estados variados
  - 1 usuario administrador (admin@example.com / password)
  - 1 usuario normal (user@example.com / password)

- **Al menos 21 publicaciones**:
  - 3 posts por cada usuario aleatorio (15 posts)
  - 5 posts para el administrador
  - 3 posts para el usuario de prueba

### Datos Realistas Generados con Faker

- **Nombres de usuario**: Generados automáticamente
- **Emails**: Emails únicos y válidos
- **Títulos de publicaciones**: Frases coherentes
- **Contenido**: Párrafos de texto realista
- **Categorías**: 10 categorías diferentes (Tecnología, Ciencia, Deportes, etc.)
- **Fechas**: Fechas aleatorias del último año
- **Visualizaciones**: Entre 0 y 10,000 views

## 🧪 Testing

### Verificar Datos en la Base de Datos

Usando Tinker:
```bash
php artisan tinker
```

```php
// Contar usuarios
User::count();

// Contar publicaciones
Post::count();

// Ver usuarios con sus posts
User::with('posts')->get();

// Ver posts de un usuario específico
User::find(1)->posts;

// Ver usuarios administradores
User::where('role', 'admin')->get();

// Ver posts publicados
Post::where('is_published', true)->get();
```

## 🏗️ Factories Personalizadas

### UserFactory

Genera usuarios con:
- Nombres y usernames únicos
- Emails únicos
- Roles aleatorios (admin/user)
- 80% de emails verificados
- 90% de usuarios activos
- Contraseña por defecto: "password"

Estados disponibles:
- `->admin()`: Crear usuario administrador
- `->active()`: Crear usuario activo
- `->inactive()`: Crear usuario inactivo
- `->unverified()`: Email no verificado

### PostFactory

Genera publicaciones con:
- Títulos realistas
- Contenido de varios párrafos
- Extractos de 200 caracteres
- 10 categorías diferentes
- 70% de posts publicados
- Visualizaciones aleatorias (0-10,000)
- Fechas de publicación del último año

Estados disponibles:
- `->published()`: Post publicado
- `->unpublished()`: Post no publicado
- `->popular()`: Post con muchas vistas (5,000-50,000)

## 📁 Estructura del Proyecto

```
Laravel_RA6_MGR/
├── app/
│   └── Models/
│       ├── User.php          # Modelo de Usuario
│       └── Post.php          # Modelo de Publicación
├── database/
│   ├── factories/
│   │   ├── UserFactory.php   # Factory de usuarios
│   │   └── PostFactory.php   # Factory de publicaciones
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   └── 2024_01_20_000001_create_posts_table.php
│   └── seeders/
│       └── DatabaseSeeder.php # Seeder principal
├── .env                       # Configuración de entorno
├── .env.example              # Ejemplo de configuración
├── composer.json             # Dependencias del proyecto
└── README.md                 # Este archivo
```

## 🔐 Usuarios de Prueba

Después de ejecutar `php artisan migrate:fresh --seed`, puedes usar:

**Administrador:**
- Email: admin@example.com
- Password: password
- Role: admin

**Usuario Normal:**
- Email: user@example.com
- Password: password
- Role: user

## 📝 Notas Importantes

- Todos los usuarios tienen la contraseña: **password**
- Los datos se generan de forma aleatoria en cada ejecución de seeders
- La relación entre User y Post es de uno a muchos (un usuario puede tener muchos posts)
- Los posts se eliminan en cascada al eliminar un usuario
- El proyecto usa Faker con localización en español (es_ES)

## 🛠️ Desarrollo

### Crear Nuevas Factories
```bash
php artisan make:factory NombreFactory --model=Modelo
```

### Crear Nuevos Seeders
```bash
php artisan make:seeder NombreSeeder
```

### Crear Nuevas Migraciones
```bash
php artisan make:migration create_tabla_table
```

## 📚 Recursos

- [Documentación de Laravel](https://laravel.com/docs)
- [Laravel Database: Seeding](https://laravel.com/docs/seeding)
- [Laravel Database: Factories](https://laravel.com/docs/eloquent-factories)
- [Faker PHP](https://fakerphp.github.io/)

## 📄 Licencia

Este proyecto es de código abierto bajo la licencia MIT.

---

**Desarrollado para:** Actividad de Seeders y Factories - Laravel  
**Fecha:** Enero 2026
