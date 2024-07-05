<?php

require_once 'setting.php';

$mysqli = new mysqli($host, $user, $pass, $data);
if ($mysqli->connect_error) {
    die('Ошибка подключения (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
}

// Количество записей на одной странице
$itemsPerPage = 4;

// Текущая страница из GET-запроса
$currentPage = isset($_GET['page']) ? (int)$_GET['page'] : 1;

//Вычисляем смещение
$offset = ($currentPage -1) * $itemsPerPage;

// Запрос для получения данных с учетом пагинации
$sql = "SELECT *, DATE(date) AS news_date FROM news ORDER BY date DESC LIMIT ?, ?";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param('ii', $offset, $itemsPerPage);
$stmt->execute();
$result = $stmt->get_result();

// Получаем данные из запроса
$news = $result->fetch_all(MYSQLI_ASSOC);

// Запрос для получения общего количества записей
$sqlCount = "SELECT COUNT(*) AS total FROM news";
$resultCount = $mysqli->query($sqlCount);
$totalItems = $resultCount->fetch_assoc()['total'];

// Вычисляем общее количество страниц
$totalPages = ceil($totalItems / $itemsPerPage);

//Закрываем соединение
$mysqli->close();

?>