<?php
$host = 'localhost';  // Możesz zmienić na odpowiedni host
$dbname = 'szkola_jazdy'; // Nazwa bazy danych
$username = 'root'; // Nazwa użytkownika bazy danych
$password = ''; // Hasło, zostaw puste, jeśli nie masz hasła

try {
    // Łączenie z bazą danych
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Połączenie nie powiodło się: " . $e->getMessage();
}
?>
