<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dostęp Zabroniony</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .access-denied-container {
            max-width: 600px;
            margin: 100px auto;
            padding: 30px;
            text-align: center;
            background-color: #fff3f3;
            border: 2px solid #ff4d4d;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(255, 77, 77, 0.2);
        }

        .access-denied-container h1 {
            color: #d8000c;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .access-denied-container p {
            color: #5c0002;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .access-denied-container a.btn {
            background-color: #d8000c;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .access-denied-container a.btn:hover {
            background-color: #a30000;
        }
    </style>
</head>
<body>
    <div class="access-denied-container">
        <h1>🚫 Dostęp Zabroniony</h1>
        <p>Nie masz uprawnień do przeglądania tej strony. Tylko administratorzy mają dostęp do Panelu Administratora.</p>
        <a href="index.php" class="btn">Powrót na stronę główną</a>
    </div>
</body>
</html>
