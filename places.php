<?php
session_start();
require_once 'config/db.php';
require_once 'config/header.php'; // Подключаем работающий header

// Получение списка мест для обмена книг из базы данных
try {
    $stmt = $pdo->query("SELECT name, address, description FROM places");
    $places = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Ошибка при получении данных: " . $e->getMessage();
    exit();
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Места для обмена книг</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<main class="main_window">
    <h1>Места для обмена книг</h1>

    <?php if (empty($places)): ?>
        <p>Места пока не добавлены. Пожалуйста, зайдите позже.</p>
    <?php else: ?>
        <div class="places-list">
            <?php foreach ($places as $place): ?>
                <div class="place-item">
                    <h2><?php echo htmlspecialchars($place['name']); ?></h2>
                    <p><strong>Адрес:</strong> <?php echo htmlspecialchars($place['address']); ?></p>
                    <p><strong>Описание:</strong> <?php echo htmlspecialchars($place['description']); ?></p>
                </div>
                <hr>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</main>
</body>
</html>
