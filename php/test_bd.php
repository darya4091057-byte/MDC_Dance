<?php
$host = 'localhost';
$dbname = 'mdc_dancing';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    echo "✅ Подключение к БД успешно!";
} catch(PDOException $e) {
    echo "❌ Ошибка подключения: " . $e->getMessage();
}
?>