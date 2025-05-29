<?php
// db.php - Połączenie z bazą danych SQLite
try {
    $pdo = new PDO('sqlite:szkola_jazdy.db'); // Ścieżka do bazy danych
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ustawienia błędów
} catch (PDOException $e) {
    echo "Błąd połączenia z bazą danych: " . $e->getMessage();
}
?>
