<?php
session_start();

// Jeśli użytkownik już jest zalogowany, przekieruj go na stronę główną
if (isset($_SESSION['user'])) {
    header("Location: index.php");
    exit();
}

$error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $login = $_POST['login'] ?? '';
    $haslo = $_POST['haslo'] ?? '';

    if ($login === 'admin' && $haslo === 'admin') {
        $_SESSION['user'] = 'admin';
        header("Location: index.php");
        exit();
    } elseif ($login === 'uzytkownik' && $haslo === 'haslo') {
        $_SESSION['user'] = 'uzytkownik';
        header("Location: index.php");
        exit();
    } else {
        $error = "Nieprawidłowy login lub hasło.";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta charset="UTF-8">
    <title>Logowanie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img">
                <h1>Szkoła Jazdy - Logowanie</h1>
            </div>
        </header>

        <main>
            <section class="login-box">
                <h2>Zaloguj się</h2>

                <?php if (!empty($error)): ?>
                    <div class="error-message"><?= htmlspecialchars($error) ?></div>
                <?php endif; ?>

                <form method="POST" class="form-box">
                    <div class="form-group">
                        <label for="login">Login:</label>
                        <input type="text" name="login" id="login" required>
                    </div>

                    <div class="form-group">
                        <label for="haslo">Hasło:</label>
                        <input type="password" name="haslo" id="haslo" required>
                    </div>

                    <button type="submit" class="btn">Zaloguj</button>
                </form>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>
</html>
