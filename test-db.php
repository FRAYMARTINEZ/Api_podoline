<?php
// Usa los mismos datos de tu .env
$host = 'localhost';
$db   = 'cflmtecc5_podoline';
$user = 'cflmtecc5_admin';
$pass = '4321Mario*';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    echo "✅ ¡Conexión exitosa a la base de datos!";
    echo "<br>Base de datos: " . $db;
    
    // Opcional: Mostrar tablas
    $tables = $pdo->query("SHOW TABLES")->fetchAll();
    echo "<br><br>Tablas:";
    print_r($tables);
    
} catch (PDOException $e) {
    echo "❌ Error de conexión: " . $e->getMessage();
}