<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szkoła Jazdy</title>
    <link rel="stylesheet" href="style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>
<body>
<div class="container">
    <header>
        <div class="logo">
            <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img">
            <h1>Szkoła Jazdy</h1>
        </div>
        <nav>
            <a href="admin_panel.php" class="btn">Panel Administratora</a>
            <a href="instruktorzy.php" class="btn">Instruktorzy</a>
            <a href="theory_lessons.php" class="btn">Lekcje Teoretyczne</a>
            <a href="logout.php" class="btn">Wyloguj</a>
        </nav>
    </header>

    <main>
             <h2>Witaj, <?= htmlspecialchars($_SESSION['user']) ?>!</h2>
        <!-- Informacje kontaktowe -->
        <section class="contact-info">
            <h2>Kontakt</h2>
            <p>Adres: ul. Przykładowa 123, 00-000 Miasto</p>
            <p>Telefon: +48 123 456 789</p>
            <p>Email: kontakt@szkola-jazdy.pl</p>
        </section>

        <!-- Cennik -->
        <section class="price-list">
            <h2>Cennik</h2>
            <div class="cards">
                <div class="card">
                    <h3>Kategoria A</h3>
                    <p>1500 zł</p>
                    <p>Motocykle</p>
                </div>
                <div class="card">
                    <h3>Kategoria B</h3>
                    <p>2000 zł</p>
                    <p>Samochody osobowe</p>
                </div>
                <div class="card">
                    <h3>Kategoria C</h3>
                    <p>2500 zł</p>
                    <p>Ciężarówki</p>
                </div>
                <div class="card">
                    <h3>Kategoria D</h3>
                    <p>3000 zł</p>
                    <p>Autobusy</p>
                </div>
            </div>
        </section>

        <!-- Wybór kategorii przy rejestracji -->
        <section class="categories">
            <h2>Wybierz kategorię prawa jazdy</h2>
            <form method="POST" action="add_participant.php">
                <label for="imie">Imię:</label>
                <input type="text" name="imie" required>

                <label for="nazwisko">Nazwisko:</label>
                <input type="text" name="nazwisko" required>

                <label for="kategoria">Kategoria:</label>
                <select name="kategoria" required>
                    <option value="A">Kategoria A (Motocykle)</option>
                    <option value="B">Kategoria B (Samochody osobowe)</option>
                    <option value="C">Kategoria C (Ciężarówki)</option>
                    <option value="D">Kategoria D (Autobusy)</option>
                </select>
                <button type="submit" class="btn">Zarejestruj się</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
    </footer>
</div>
</body>
</html>
