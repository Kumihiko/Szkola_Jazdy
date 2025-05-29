<?php
session_start();
// Sprawdzenie czy użytkownik to admin
if (!isset($_SESSION['user']) || $_SESSION['user'] !== 'admin') {
    header('Location: access_denied.php');
    exit;
}

include 'db_connect.php'; // Połączenie z bazą

$query = "SELECT * FROM lekcje_teoretyczne";
$stmt = $pdo->query($query);

$kursanciQuery = "SELECT * FROM Kursanci";
$kursanciStmt = $pdo->query($kursanciQuery);

$instruktorzyQuery = "SELECT * FROM Instruktorzy";
$instruktorzyStmt = $pdo->query($instruktorzyQuery);

// Edycja kursanta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id'], $_POST['edit_imie'], $_POST['edit_nazwisko'], $_POST['edit_kategoria'])) {
    $stmtUpdate = $pdo->prepare("UPDATE Kursanci SET Imie = ?, Nazwisko = ?, Kategoria = ? WHERE ID_Kursanta = ?");
    $stmtUpdate->execute([$_POST['edit_imie'], $_POST['edit_nazwisko'], $_POST['edit_kategoria'], $_POST['edit_id']]);
}

// Usunięcie kursanta
if (isset($_GET['delete_id'])) {
    $stmtDelete = $pdo->prepare("DELETE FROM Kursanci WHERE ID_Kursanta = ?");
    $stmtDelete->execute([$_GET['delete_id']]);
}

// Przypisanie instruktora do lekcji
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lekcja_id'], $_POST['instruktor_id'])) {
    $stmtUpdate = $pdo->prepare("UPDATE lekcje_teoretyczne SET ID_Instruktora = ? WHERE ID_Lekcji = ?");
    $stmtUpdate->execute([$_POST['instruktor_id'], $_POST['lekcja_id']]);
}

// Przypisanie instruktora do kursanta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kursant_id'], $_POST['instruktor_id_kursant'])) {
    $stmtUpdate = $pdo->prepare("UPDATE Kursanci SET ID_Instruktora = ? WHERE ID_Kursanta = ?");
    $stmtUpdate->execute([$_POST['instruktor_id_kursant'], $_POST['kursant_id']]);
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <title>Panel Administratora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
        <div class="logo">
            <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img">
            <h1>Panel Administratora</h1>
        </div>
        <nav>
            <a href="index.php" class="btn">Strona Główna</a>
        </nav>
    </header>

    <main>
        <!-- Lista kursantów -->
        <section class="kursanci-list">
            <h2>Lista Kursantów</h2>
            <table class="table">
                <thead>
                <tr>
                    <th>ID Kursanta</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Kategoria Prawa Jazdy</th>
                    <th>Instruktor</th>
                    <th>Akcje</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($kursant = $kursanciStmt->fetch(PDO::FETCH_ASSOC)): ?>
                    <tr>
                        <td data-label="ID Kursanta"><?= $kursant['ID_Kursanta'] ?></td>
                        <td data-label="Imię"><?= $kursant['Imie'] ?></td>
                        <td data-label="Nazwisko"><?= $kursant['Nazwisko'] ?></td>
                        <td data-label="Kategoria Prawa Jazdy">
                            <form method="POST" class="inline-form">
                                <input type="hidden" name="edit_id" value="<?= $kursant['ID_Kursanta'] ?>">
                                <input type="hidden" name="edit_imie" value="<?= $kursant['Imie'] ?>">
                                <input type="hidden" name="edit_nazwisko" value="<?= $kursant['Nazwisko'] ?>">
                                <select name="edit_kategoria" required>
                                    <option value="A" <?= $kursant['Kategoria'] == 'A' ? 'selected' : '' ?>>A</option>
                                    <option value="B" <?= $kursant['Kategoria'] == 'B' ? 'selected' : '' ?>>B</option>
                                    <option value="C" <?= $kursant['Kategoria'] == 'C' ? 'selected' : '' ?>>C</option>
                                    <option value="D" <?= $kursant['Kategoria'] == 'D' ? 'selected' : '' ?>>D</option>
                                </select>
                                <button type="submit" class="btn">Edytuj</button>
                            </form>
                        </td>
                        <td data-label="Instruktor">
                            <form method="POST" class="inline-form">
                                <input type="hidden" name="kursant_id" value="<?= $kursant['ID_Kursanta'] ?>">
                                <select name="instruktor_id_kursant" required>
                                    <?php 
                                    $instruktorzyStmt = $pdo->query("SELECT * FROM Instruktorzy");
                                    while ($instr = $instruktorzyStmt->fetch(PDO::FETCH_ASSOC)): ?>
                                        <option value="<?= $instr['ID_Instruktora'] ?>" <?= $kursant['ID_Instruktora'] == $instr['ID_Instruktora'] ? 'selected' : '' ?>>
                                            <?= $instr['Imie'] ?> <?= $instr['Nazwisko'] ?>
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                                <button type="submit" class="btn">Przypisz</button>
                            </form>
                        </td>
                        <td data-label="Akcje">
                            <a href="?delete_id=<?= $kursant['ID_Kursanta'] ?>" class="btn delete-btn">Usuń</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
                </tbody>
            </table>
        </section>

        <!-- Przypisywanie instruktorów do lekcji -->
        <section class="assign-instructor">
            <h2>Przypisz Instruktora do Lekcji</h2>
            <form method="POST" class="form-box">
                <div class="form-group">
                    <label for="lekcja_id">Wybierz Lekcję:</label>
                    <select name="lekcja_id" id="lekcja_id" required>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $row['ID_Lekcji'] ?>">
                                Lekcja <?= $row['ID_Lekcji'] ?> - <?= $row['Sala'] ?> (<?= $row['Data'] ?>, <?= $row['Godzina'] ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="instruktor_id">Wybierz Instruktora:</label>
                    <select name="instruktor_id" id="instruktor_id" required>
                        <?php 
                        $instruktorzyStmt = $pdo->query("SELECT * FROM Instruktorzy");
                        while ($instr = $instruktorzyStmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <option value="<?= $instr['ID_Instruktora'] ?>">
                                <?= $instr['Imie'] ?> <?= $instr['Nazwisko'] ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <button type="submit" class="btn">Przypisz Instruktora</button>
            </form>
        </section>
    </main>

    <footer>
        <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
    </footer>
</div>
</body>
</html>
