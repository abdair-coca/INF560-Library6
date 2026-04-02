# 📚 Library App - Sistema de Gestión de Biblioteca

**Materia:** INF560 - Desarrollo Web Backend  
**Universidad:** Universidad Autónoma Tomás Frías (UATF), Potosí, Bolivia  
**Profesor:** M. Sc. Huáscar Fedor Gonzales Guzmán  
**Versión:** 1.0.0

---

## 📋 Descripción del Proyecto

Library App es un sistema de gestión de biblioteca desarrollado con **Laravel 13**, **PHP 8.3+** y **PostgreSQL**. Es un proyecto incremental donde cada guía de laboratorio añade nuevas funcionalidades, desde la configuración inicial hasta la creación de una API RESTful profesional.

---

## ⚙️ Requisitos Previos

- **PHP** 8.3 o superior
- **Composer** (gestor de dependencias)
- **PostgreSQL** 14 o superior
- **Git** (control de versiones)
- **Node.js** 18+ (para compilación de assets)

### Verificar Instalaciones

```bash
php --version
composer --version
psql --version
git --version
node --version
```

---

## 🚀 Guía de Instalación y Puesta en Funcionamiento

### 1. Clonar el Repositorio

```bash
git clone https://github.com/HuascarFedor/INF560_libraryApp.git
cd INF560_libraryApp
```

### 2. Configurar Variables de Entorno

```bash
cp .env.example .env
```

Edita `.env` con tus credenciales:

```env
APP_NAME="Library App"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

# Base de Datos
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=library_db
DB_USERNAME=postgres
DB_PASSWORD=tu_contraseña_postgres

# Otros
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
MAIL_MAILER=log
```

### 3. Crear la Base de Datos PostgreSQL

```bash
psql -U postgres
```

Dentro de PostgreSQL:

```sql
CREATE DATABASE library_db;
\q
```

### 4. Instalar Dependencias PHP

```bash
composer install
```

### 5. Generar Clave de Aplicación

```bash
php artisan key:generate
```

### 6. Ejecutar Migraciones

```bash
php artisan migrate --seed
```

### 7. Instalar Dependencias Frontend (Opcional)

```bash
npm install
npm run dev
```

### 8. Iniciar el Servidor

```bash
php artisan serve
```

Accede a: **http://localhost:8000**

---

## 🔧 Comandos Útiles

```bash
# Ver todas las rutas
php artisan route:list

# Crear seeder
php artisan make:seeder NombreSeeder

# Crear migración
php artisan make:migration create_nombre_table

# Crear modelo con migración
php artisan make:model NombreModelo -m

# Crear controlador
php artisan make:controller NombreController --resource

# Refrescar BD con seeders
php artisan migrate:refresh --seed

# Limpiar cache
php artisan cache:clear
php artisan config:clear

# Abrir Tinker (REPL)
php artisan tinker
```

---

## 📚 Guías de Laboratorio

### Guía 4: Configuración del Proyecto y Base de Datos

**Tag:** `v0.1.0`  
**Duración:** 2 horas

#### Objetivos de Aprendizaje

- Crear un proyecto Laravel 13 desde cero
- Configurar conexión a PostgreSQL
- Entender la estructura de directorios de Laravel
- Diseñar esquema relacional de biblioteca
- Crear migraciones para todas las tablas principales
- Implementar control de versiones con Git y GitHub
- Usar tags de Git para marcar hitos

#### Dominio del Proyecto

- **Tablas:** authors, categories, books, author_book (pivote), members, loans, users
- **Relaciones:** One-to-Many (Author → Books), Many-to-Many (Books ↔ Categories), Loans
- **Reglas:** Miembro máximo N préstamos, libro disponible si hay copias, fecha de devolución esperada

---

### Guía 5: Modelos, Migraciones y Relaciones

**Tag:** `v0.2.0`  
**Duración:** 3 horas  
**Requisito:** Guía 1

#### Objetivos de Aprendizaje

- Crear modelos Eloquent con `$fillable` y `$casts`
- Implementar accessors y mutators
- Definir relaciones: `belongsToMany`, `hasMany`, `belongsTo`, `hasOne`
- Entender el uso de tabla pivote con `withPivot()`
- Crear factories con datos realistas
- Implementar seeders con lógica de negocio
- Verificar relaciones en Tinker (REPL de Laravel)
- Usar `withCount()` para agregaciones

#### Modelos Creados

- Author (con relación belongsToMany a Book)
- Category (hasMany Books)
- Book (con relaciones a Author, Category, Loan)
- Member (hasOne User, hasMany Loan)
- Loan (belongsTo Book, Member, User)

---

### Guía 6: Rutas, Controladores y Vistas Blade

**Tag:** `v0.3.0`  
**Duración:** 3 horas  
**Requisito:** Guía 2

#### Objetivos de Aprendizaje

- Crear rutas RESTful con `Route::resource()`
- Implementar los 7 métodos CRUD en controladores
- Usar route model binding para inyección automática
- Aplicar eager loading con `with()` para optimizar queries
- Crear layout base con Blade
- Implementar vistas con grid responsivo (Tailwind CSS)
- Crear componentes Blade reutilizables
- Mostrar mensajes flash de éxito/error

#### Controladores Implementados

- BookController: index, show, create
- AuthorController: index, show
- CategoriesController (ejercicio propuesto)

#### Componentes Blade

- `<x-book-status-badge />` (verde/amarillo/rojo)
- `<x-category-badge />` (color dinámico)
- `<x-book-card />` (card reutilizable)

---

### Guía 7: CRUD Completo con Formularios

**Tag:** `v0.4.0`  
**Duración:** 4 horas  
**Requisito:** Guía 3

#### Objetivos de Aprendizaje

- Crear formularios HTML con protección CSRF
- Implementar métodos store() y update() en controladores
- Usar `old()` para mantener valores en caso de error
- Sincronizar relaciones Many-to-Many con `sync()`
- Implementar eliminación lógica (soft delete)
- Verificar restricciones de negocio antes de eliminar
- Refactorizar código con partials (_form.blade.php)
- Manejar redirecciones y mensajes flash

#### Funcionalidades CRUD

- Crear, editar y eliminar libros y autores
- Asociar múltiples autores a cada libro
- Restaurar libros eliminados (soft delete)
- Validar que no se eliminen libros con préstamos activos

---

### Guía 8: Validación Avanzada con Form Requests

**Tag:** `v0.5.0`  
**Duración:** 3 horas  
**Requisito:** Guía 4

#### Objetivos de Aprendizaje

- Crear Form Requests personalizados
- Implementar reglas de validación complejas
- Proporcionar mensajes de error en español
- Crear reglas de validación custom (p. ej., validar ISBN)
- Usar `prepareForValidation()` para sanitizar datos
- Implementar validación condicional con reglas dinámicas
- Mostrar errores de validación en vistas Blade
- Usar `Rule::unique()` para ignorar registros específicos en validación

#### Form Requests Creados

- StoreBookRequest / UpdateBookRequest
- StoreAuthorRequest / UpdateAuthorRequest
- StoreCategoryRequest / UpdateCategoryRequest

#### Reglas Personalizadas

- ValidIsbn (validar ISBN-13 algorítmicamente)
- ValidSlug (slug único, solo caracteres válidos)

---

### Guía 9: Autenticación de Usuario

**Tag:** `v0.6.0`  
**Duración:** 3 horas  
**Requisito:** Guía 5

#### Objetivos de Aprendizaje

- Implementar sistema de registro de usuarios
- Implementar login con sesiones y `Auth::attempt()`
- Hash de contraseñas con bcrypt/Argon2id
- Implementar logout con invalidación de sesión
- Crear middleware personalizado
- Proteger rutas con `middleware('auth')`
- Usar directivas Blade `@auth` y `@guest`
- Implementar roles de usuario (admin, librarian, member)
- Crear miembros automáticamente al registrarse
- Generar códigos de miembro únicos (LIB-YYYYMMDD-XXXX)

#### Rutas Protegidas

- Lectura (index, show): públicas
- Escritura (create, store, edit, update, destroy): requieren autenticación

#### Roles Implementados

- **admin:** gestiona todo
- **librarian:** gestiona contenido (libros, autores) y préstamos
- **member:** consulta catálogo, ve sus préstamos

---

### Guía 10: Autorización con Policies y Gates

**Tag:** `v0.7.0`  
**Duración:** 3 horas  
**Requisito:** Guía 6

#### Objetivos de Aprendizaje

- Implementar Gates para permisos globales
- Crear Policies para autorización sobre modelos
- Usar `$this->authorize()` en controladores
- Aplicar directivas `@can` en vistas
- Crear vistas de error 403 personalizadas
- Implementar lógica de negocio en préstamos (validaciones)
- Crear módulo básico de préstamos con create, store, return
- Usar método `can()` en modelos para verificar permisos

#### Gates Implementados

- manage-users (solo admin)
- manage-loans (admin + librarian)
- view-reports (admin + librarian)
- manage-system (solo admin)

#### Policies Creadas

- BookPolicy (viewAny, view, create, update, delete, restore)
- AuthorPolicy (misma lógica que BookPolicy)
- LoanPolicy (diferenciado por rol y propiedad)
- MemberPolicy (ejercicio propuesto)

---

### Guía 11: Relaciones Avanzadas y Filtrado

**Tag:** `v0.8.0`  
**Duración:** 4 horas  
**Requisito:** Guía 7

#### Objetivos de Aprendizaje

- Identificar y resolver problema N+1 queries
- Usar eager loading con `with()` y `load()`
- Implementar query scopes locales
- Usar `whereHas()` para consultas anidadas
- Crear filtros por búsqueda, categoría, idioma, disponibilidad
- Implementar ordenamiento dinámico (título, año, popularidad)
- Preservar filtros en paginación
- Crear dashboard de estadísticas (solo librarian/admin)
- Mostrar libros próximos a devolver con badge en navbar

#### Scopes Implementados (Book)

- scopeAvailable() - libros disponibles
- scopeByCategory() - filtrar por categoría
- scopeByLanguage() - filtrar por idioma
- scopeByYear() / scopeByYearRange() - filtrar por año(s)
- scopeSearch() - búsqueda fulltext en título/ISBN
- scopePopular() - ordenar por número de préstamos
- scopeByAuthor() - filtrar por nombre del autor (con whereHas)

#### Scopes Implementados (Loan)

- scopeActive() - préstamos no devueltos
- scopeOverdue() - préstamos vencidos
- scopeDueSoon() - préstamos que vencen pronto
- scopeByMember() - filtrar por miembro

#### Dashboard

- Total de libros
- Libros disponibles / no disponibles
- Préstamos activos / vencidos
- Top 5 libros más prestados
- Tabla de préstamos vencidos

---

### Guía 12: API RESTful con Laravel

**Tag:** `v0.9.0`  
**Duración:** 4 horas  
**Requisito:** Guía 8

#### Objetivos de Aprendizaje

- Entender fundamentos de APIs REST
- Diseñar endpoints siguiendo convenciones REST
- Crear API Resources para transformar datos
- Implementar autenticación con Sanctum (tokens)
- Proteger rutas API con middleware `auth:sanctum`
- Usar Form Requests en API para validación
- Configurar manejo de errores en JSON
- Implementar rate limiting
- Documentar API con Postman/Thunder Client
- Versionar API (/api/v1/)

#### Controladores API Creados

- Api\BookController (CRUD completo + filtrados)
- Api\AuthorController (index, show)
- Api\CategoryController (CRUD completo)
- Api\LoanController (index, store, returnBook)
- Api\AuthController (register, login, logout, me)

#### API Resources

- BookResource (título, ISBN, autores, categoría, etc.)
- AuthorResource (nombre, nacionalidad, biografía, etc.)
- CategoryResource (nombre, slug, color, etc.)
- LoanResource (fechas, estado, libro, miembro, etc.)

#### Rutas API

```
GET    /api/books             (público)
GET    /api/books/{id}        (público)
POST   /api/books             (autenticado)
PUT    /api/books/{id}        (autenticado)
DELETE /api/books/{id}        (autenticado)

GET    /api/loans             (autenticado)
POST   /api/loans             (autenticado)
POST   /api/loans/{id}/return (autenticado)

POST   /api/register          (público)
POST   /api/login             (público)
POST   /api/logout            (autenticado)
GET    /api/me                (autenticado)
```

#### Autenticación API

- Tokens con Sanctum
- Header `Authorization: Bearer {token}`
- Generación de token en login/register
- Revocación de token en logout

---

## 📊 Estructura de Progresión

| Guía | Título | Dependencia | Hito |
|------|--------|-------------|------|
| 1 | Configuración y BD | - | Setup & Base |
| 2 | Modelos y Relaciones | G1 | Setup & Base |
| 3 | Rutas y Vistas Blade | G2 | CRUD Básico |
| 4 | CRUD Completo | G3 | CRUD Básico |
| 5 | Validación Avanzada | G4 | Validación & Auth |
| 6 | Autenticación | G5 | Validación & Auth |
| 7 | Autorización | G6 | Seguridad & Optimización |
| 8 | Relaciones Avanzadas | G7 | Seguridad & Optimización |
| 9 | API RESTful | G8 | API RESTful |

---

## 🎯 Esquema de Base de Datos

### Tablas Principales

```
users (Laravel)
├─ id, name, email, password, role, timestamps

authors
├─ id, first_name, last_name, nationality, birth_date, biography, timestamps

categories
├─ id, name, slug, description, color, timestamps

books
├─ id, title, isbn, publisher, publish_year, pages, language
├─ description, cover_url, total_copies, available_copies, status
├─ category_id (FK), timestamps, soft_deletes

author_book (pivote)
├─ id, author_id (FK), book_id (FK), role, timestamps
└─ unique constraint: [author_id, book_id]

members
├─ id, user_id (FK, unique), member_code, phone, address
├─ membership_type, membership_expires_at, max_loans, is_active, timestamps

loans
├─ id, book_id (FK), member_id (FK), loaned_by (FK → users)
├─ loan_date, due_date, returned_date, status, notes, timestamps
```

---

## 🔐 Roles y Permisos

### Admin
- Gestiona usuarios, libros, autores, categorías
- Registra préstamos y devoluciones
- Accede a reportes y estadísticas
- Puede eliminar registros

### Librarian
- Gestiona contenido (libros, autores, categorías)
- Registra préstamos y devoluciones
- Accede a reportes (lecturas)
- No puede eliminar (solo admin)

### Member
- Consulta catálogo de libros
- Ve sus propios préstamos
- Sin permisos de escritura

---

## 📦 Stack Tecnológico

| Capa | Tecnología | Versión |
|------|-----------|---------|
| Framework | Laravel | 13 |
| Lenguaje Backend | PHP | 8.3+ |
| Base de Datos | PostgreSQL | 14+ |
| Templating | Blade | Nativo |
| Frontend | Tailwind CSS | 3.x |
| Autenticación API | Sanctum | Nativo |
| Control de Versiones | Git | - |

---

## 🐛 Solución de Problemas

### Error: "No such file or directory" en `.env`
```bash
cp .env.example .env
```

### Error de conexión a PostgreSQL
Verifica que PostgreSQL esté corriendo y las credenciales en `.env` sean correctas:
```bash
psql -U postgres -d library_app
```

### Error: "Class 'PDO' not found"
```bash
sudo apt-get install php-pgsql
```

### Permiso denegado en carpeta `storage`
```bash
sudo chown -R $USER:$USER storage/
sudo chmod -R 755 storage/
```

### Puerto 8000 ya en uso
```bash
php artisan serve --port=8001
```

---

## 📚 Recursos y Documentación

### Documentación Oficial
- [Laravel 13 Documentation](https://laravel.com/docs/13)
- [Eloquent ORM Guide](https://laravel.com/docs/13/eloquent)
- [Blade Templating](https://laravel.com/docs/13/blade)
- [PostgreSQL Documentation](https://www.postgresql.org/docs/)

### Herramientas Recomendadas
- **IDE:** Visual Studio Code + Laravel Extension
- **Terminal:** iTerm2 (macOS) + Oh My Zsh
- **API Testing:** Postman / Thunder Client / Insomnia
- **Database Manager:** pgAdmin / DBeaver

---

## 📝 Estándares de Código

### Convenciones de Nombrado

- **Modelos:** PascalCase singular (Book, Author)
- **Tablas:** snake_case plural (books, authors)
- **Controladores:** PascalCase + "Controller" (BookController)
- **Métodos:** camelCase (getPublishedBooks)
- **Variables:** camelCase ($publishedBooks)
- **Constantes:** UPPER_SNAKE_CASE (MAX_LOANS)

### Commits en Git

```bash
# Crear feature
git commit -m "feat: descripción de la feature"

# Arreglar bug
git commit -m "fix: descripción del arreglo"

# Refactorizar
git commit -m "refactor: descripción de cambios"

# Documentación
git commit -m "docs: descripción de cambios"
```

### Versionado

Cada guía tiene un tag Git:
```bash
git tag -a v0.1.0 -m "Guía 4: Configuración"
git push --tags
```

---

## 👨‍🎓 Recomendaciones para Estudiantes

1. **Lee la documentación oficial antes de preguntar**
2. **Mantén commits pequeños y descriptivos**
3. **Prueba cada funcionalidad al terminar cada guía**
4. **Usa Tinker para explorar las relaciones**
5. **Verifica que las migraciones ejecuten correctamente**
6. **Considera agregar tests unitarios a partir de Guía 4**
7. **Documenta tu código con comentarios PHPDoc**
8. **Respeta las convenciones de nombrado**

---

## 📞 Soporte

- **Correo:** huascar.fedor@gmail.com
- **Horario:** Lunes a viernes, 14:00 - 16:00
- **GitHub Issues:** Para problemas técnicos documentados

**Respuesta esperada:** 24-48 horas

---

## 📄 Licencia

Este proyecto es material educativo de UATF para la materia INF560.

---

**Última actualización:** 2 de abril de 2026  
*Documento generado para INF560 - Desarrollo Web Backend (UATF)*