<?php
// php/admin.php
// ==================================================
// АДМИН-ПАНЕЛЬ ДЛЯ ПРОСМОТРА ЗАЯВОК
// ==================================================

// Простая проверка пароля (в реальном проекте используйте нормальную авторизацию)
$password = isset($_GET['password']) ? $_GET['password'] : '';
$ADMIN_PASSWORD = 'admin123'; // В реальном проекте измените!

if ($password !== $ADMIN_PASSWORD) {
    // Показываем форму входа
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>MDC Dancing - Админ-панель</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="bg-dark text-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card bg-secondary">
                        <div class="card-body">
                            <h3 class="text-center">🔐 Вход</h3>
                            <form method="GET">
                                <input type="password" name="password" class="form-control mb-3" placeholder="Введите пароль" required>
                                <button type="submit" class="btn btn-danger w-100">Войти</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Если пароль верный — показываем заявки
$SECRET_TOKEN = 'mdc_admin_2025_secret';
$api_url = "get_bookings.php?token=$SECRET_TOKEN";

// Получаем данные через curl
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response, true);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>MDC Dancing - Админ-панель</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #1a1a1a; color: #e8e8e8; }
        .table-dark { background: #2a2a2a; }
        .status-new { background: #ff6b6b; padding: 3px 12px; border-radius: 20px; }
        .status-processed { background: #ffc107; padding: 3px 12px; border-radius: 20px; color: #000; }
        .status-completed { background: #28a745; padding: 3px 12px; border-radius: 20px; }
    </style>
</head>
<body>
    <div class="container py-4">
        <h1 class="mb-4">📋 MDC Dancing — Заявки</h1>
        <a href="?password=<?= $ADMIN_PASSWORD ?>" class="btn btn-outline-light btn-sm mb-3">Обновить</a>
        <a href="admin.php" class="btn btn-outline-danger btn-sm mb-3">Выйти</a>
        
        <?php if ($data && $data['success']): ?>
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Имя</th>
                            <th>Телефон</th>
                            <th>Email</th>
                            <th>Стиль</th>
                            <th>Дата</th>
                            <th>Статус</th>
                            <th>Создано</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['bookings'] as $booking): ?>
                            <tr>
                                <td><?= $booking['id'] ?></td>
                                <td><strong><?= htmlspecialchars($booking['name']) ?></strong></td>
                                <td><?= htmlspecialchars($booking['phone']) ?></td>
                                <td><?= htmlspecialchars($booking['email']) ?: '—' ?></td>
                                <td><span class="badge bg-danger"><?= htmlspecialchars($booking['style']) ?></span></td>
                                <td><?= $booking['date'] ?: '—' ?></td>
                                <td>
                                    <span class="status-<?= $booking['status'] ?>">
                                        <?= $booking['status'] ?>
                                    </span>
                                </td>
                                <td><?= date('d.m.Y H:i', strtotime($booking['created_at'])) ?></td>
                            </tr>
                            <?php if ($booking['message']): ?>
                                <tr>
                                    <td colspan="8" style="color: #888; font-size: 13px;">
                                        💬 <em><?= htmlspecialchars($booking['message']) ?></em>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <p class="text-secondary">Всего заявок: <strong><?= $data['count'] ?></strong></p>
        <?php else: ?>
            <div class="alert alert-warning">Нет заявок или ошибка загрузки</div>
        <?php endif; ?>
    </div>
</body>
</html>