<?php
// php/get_bookings.php
// ==================================================
// ПОЛУЧЕНИЕ ВСЕХ ЗАЯВОК (ДЛЯ АДМИНА)
// ==================================================

require_once 'config.php';

// Базовое ограничение доступа (только для разработки)
// В реальном проекте добавьте проверку сессии/токена
$auth_token = isset($_GET['token']) ? $_GET['token'] : '';

// Простой токен для защиты (в реальном проекте используйте нормальную авторизацию)
$SECRET_TOKEN = 'mdc_admin_2025_secret';

if ($auth_token !== $SECRET_TOKEN) {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Неавторизованный доступ']);
    exit;
}

// Получаем все заявки (сортировка от новых к старым)
try {
    $sql = "SELECT * FROM bookings ORDER BY created_at DESC";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $bookings = $stmt->fetchAll();
    
    echo json_encode([
        'success' => true,
        'count' => count($bookings),
        'bookings' => $bookings
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка при получении заявок',
        'error' => $e->getMessage()
    ]);
}
?>