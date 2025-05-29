<?php
include 'db_connect.php'; // Połączenie z bazą danych

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['imie']) && isset($_POST['nazwisko']) && isset($_POST['kategoria'])) {
    // Pobieranie danych z formularza
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];
    $kategoria = $_POST['kategoria'];

    // Dodanie kursanta do bazy danych
    $insertQuery = "INSERT INTO Kursanci (Imie, Nazwisko, Kategoria) VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($insertQuery);
    $stmt->execute([$imie, $nazwisko, $kategoria]);

    // Przekierowanie na stronę główną po zapisaniu
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Rejestracja Kursanta</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img">
                <h1>Rejestracja Kursanta</h1>
            </div>
            <nav>
                <a href="index.php" class="btn">Strona Główna</a>
            </nav>
        </header>

        <main>
            <section class="registration-form">
                <h2>
