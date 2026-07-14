<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode(['success' => false, 'message' => 'Метод не разрешён']);
    exit;
}

$name = isset($_POST['name']) ? trim($_POST['name']) : '';
$phone = isset($_POST['phone']) ? trim($_POST['phone']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';
$style = isset($_POST['style']) ? trim($_POST['style']) : '';
$date = isset($_POST['date']) && $_POST['date'] ? $_POST['date'] : null;
$message = isset($_POST['message']) ? trim($_POST['message']) : '';

if (empty($name) || empty($phone) || empty($style)) {
    echo json_encode(['success' => false, 'message' => 'Заполните все обязательные поля']);
    exit;
}

try {
    $sql = "INSERT INTO bookings (name, phone, email, style, date, message) 
            VALUES (:name, :phone, :email, :style, :date, :message)";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'style' => $style,
        'date' => $date,
        'message' => $message
    ]);
    
    echo json_encode([
        'success' => true,
        'message' => 'Заявка успешно отправлена! Мы свяжемся с вами в ближайшее время.'
    ]);
    
} catch(PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Ошибка при сохранении заявки',
        'error' => $e->getMessage()
    ]);
}
?>