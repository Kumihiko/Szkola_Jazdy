<?php
include 'db_connect.php'; // Połączenie z bazą

// Pobieranie danych z tabeli Lekcje Teoretyczne oraz Instruktorów
$query = "SELECT lekcje_teoretyczne.*, Instruktorzy.Imie, Instruktorzy.Nazwisko 
          FROM lekcje_teoretyczne 
          LEFT JOIN Instruktorzy ON lekcje_teoretyczne.ID_Instruktora = Instruktorzy.ID_Instruktora";
$stmt = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <title>Zajęcia Teoretyczne - Szkoła Jazdy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img">
                <h1>Szkoła Jazdy - Bezpieczna Przyszłość</h1>
            </div>
            <nav>
                <a href="index.php" class="btn">Strona Główna</a>
            </nav>
        </header>

        <main>
            <section class="theory-lessons">
                <h2>Zajęcia Teoretyczne</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Lekcji</th>
                            <th>Imię Instruktora</th>
                            <th>Nazwisko Instruktora</th>
                            <th>Sala</th>
                            <th>Data</th>
                            <th>Godzina</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $row['ID_Lekcji'] ?></td>
                                <td><?= $row['Imie'] ?></td>
                                <td><?= $row['Nazwisko'] ?></td>
                                <td><?= $row['Sala'] ?></td>
                                <td><?= $row['Data'] ?></td>
                                <td><?= $row['Godzina'] ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>
</html>
