-- ============================================
-- Script SQL para crear Base de Datos
-- Proyecto: Laravel RA6 MGR
-- ============================================

-- Eliminar base de datos si existe (¡CUIDADO! Elimina todos los datos)
DROP DATABASE IF EXISTS laravel_ra6_mgr;

-- Crear la base de datos con codificación UTF-8
CREATE DATABASE laravel_ra6_mgr
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

-- Seleccionar la base de datos
USE laravel_ra6_mgr;

-- Mostrar mensaje de éxito
SELECT 'Base de datos laravel_ra6_mgr creada exitosamente' AS Resultado;

-- ============================================
-- Información de la Base de Datos
-- ============================================

SHOW DATABASES LIKE 'laravel_ra6_mgr';

-- ============================================
-- Instrucciones de Uso
-- ============================================
-- 
-- Para ejecutar este script:
-- 
-- 1. Desde phpMyAdmin:
--    - Abre phpMyAdmin en http://localhost/phpmyadmin
--    - Ve a la pestaña "SQL"
--    - Pega este código y haz clic en "Continuar"
-- 
-- 2. Desde línea de comandos:
--    mysql -u root -p < database_setup.sql
-- 
-- 3. Después de crear la base de datos:
--    cd c:\xampp\Laravel\Laravel_RA6_MGR
--    php artisan migrate:fresh --seed
--
-- ============================================
