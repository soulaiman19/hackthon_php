<?php
// Configuration PDO - Base de donnees MySQL
$host = 'localhost';
$dbname = 'app_php';
$user = 'root';
$pass = '';

function ensureColumnExists(PDO $pdo, string $table, string $column, string $definition): void
{
    $stmt = $pdo->prepare(
        'SELECT COUNT(*)
         FROM INFORMATION_SCHEMA.COLUMNS
         WHERE TABLE_SCHEMA = DATABASE()
           AND TABLE_NAME = :table_name
           AND COLUMN_NAME = :column_name'
    );
    $stmt->execute([
        'table_name' => $table,
        'column_name' => $column,
    ]);

    if ((int) $stmt->fetchColumn() === 0) {
        $pdo->exec(sprintf('ALTER TABLE %s ADD COLUMN %s %s', $table, $column, $definition));
    }
}

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Create the table for fresh installs.
    $sql = "CREATE TABLE IF NOT EXISTS users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        family_name VARCHAR(100) NOT NULL,
        date_of_birth DATE NOT NULL,
        email VARCHAR(255) UNIQUE NOT NULL,
        password VARCHAR(255) NOT NULL,
        verified TINYINT DEFAULT 0,
        verification_code VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";

    $pdo->exec($sql);

    // Keep existing installations in sync without dropping user data.
    ensureColumnExists($pdo, 'users', 'name', 'VARCHAR(100) NULL AFTER id');
    ensureColumnExists($pdo, 'users', 'family_name', 'VARCHAR(100) NULL AFTER name');
    ensureColumnExists($pdo, 'users', 'date_of_birth', 'DATE NULL AFTER family_name');
} catch (PDOException $e) {
    die('Erreur de connexion a la base de donnees : ' . htmlspecialchars($e->getMessage()));
}
