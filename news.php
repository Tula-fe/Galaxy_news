<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Galaxy News</title>
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/style.css">
    <?php require_once 'apps/announce.php' ?>
    <?php require_once 'apps/tetsPagination.php' ?>
    <style>
        .banner__wrapper {
              background-image: url(/images/<?php echo $announceImage ?>);
        }
    </style>
    <?php

require_once 'apps/setting.php';

// Создаем соединение
$mysqli = new mysqli($host, $user, $pass, $data);

// Проверяем соединение
if ($mysqli->connect_error) {
    die('Ошибка подключения (' . $mysqli->connect_errno . ')' . $mysqli->connect_error);
}

// Получаем идентификатор новости из параметра URL
$newsId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if ($newsId > 0) {
    // Запрос для получения данных одной новости по идентификатору
    $sql = "SELECT *, DATE(date) AS news_date FROM news WHERE id = ?";
    $stmt = $mysqli->prepare($sql); // Подготовка запроса
    $stmt->bind_param('i', $newsId); // Привязка параметра
    $stmt->execute(); // Выполнение запроса
    $result = $stmt->get_result(); // Получение результата запроса

    if ($result->num_rows > 0) {
        // Получаем данные из запроса
        $article = $result->fetch_assoc();

        $news_date = $article['news_date'];
        $title = $article['title'];
        $announce = $article['announce'];
        $content = $article['content'];
        $image = $article['image'];

    } else {
        echo '<p>Новость не найдена.</p>';
    }

    $stmt->close();
} else {
    echo '<p>Некорректный идентификатор новости</p>';
}

$announce = str_replace('<p>', '', $announce);
$announce = str_replace('</p>', '', $announce);

$content = str_replace('<p>', '<p class="page__descr">', $content);
$content = str_replace('</p>', '', $content);

// Закрываем соединение
$mysqli->close();

?>
</head>

<body>
    <header class="header header_news">
        <div class="container">
            <a href="#">
                <img class="logo" src="/img/logo.png" alt="GalaxyNews">
            </a>
        </div>
    </header>

    <section class="news">
        <div class="container">
            <span class="news__nav">
                <a href="index.php">Главная</a> / <a href="#"><?php echo $title ?></a>
            </span>
            <h2 class="news__title">
                <?php echo $title ?>
            </h2>
            <div class="wrapper">
                <div class="news__content">
                    <p class="page__data"> <?php echo $news_date ?> </p>
                    <p class="page__announce"> <?php echo $announce ?> </p>
                    <p class="page__descr"> <?php echo $content ?> </p>
                    <a href="index.php" class="page__button"><svg class="button__arrow_left" width="26.003906" height="13.321899" viewBox="0 0 26.0039 13.3219" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><defs/>
	                <path id="Arrow 1" d="M3.41 5.66L7.36 1.71C7.76 1.31 7.76 0.69 7.36 0.29C6.97 -0.1 6.34 -0.1 5.95 0.29L0.29 5.95C-0.1 6.34 -0.1 6.97 0.29 7.36L5.95 13.02C6.34 13.42 6.97 13.42 7.36 13.02C7.76 12.62 7.76 12 7.36 11.61L3.41 7.66L26 7.66L26 5.66L3.41 5.66Z" fill="#841844" fill-opacity="1.000000" fill-rule="evenodd"/>
                    </svg> Назад к новостям</a>
                </div>
                <img src="/images/<?php echo $image ?>" alt="">
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="container">
            <p class="footer__descr">
                © 2023 — 2412 «Галактический вестник»
            </p>
        </div>
    </footer>
</body>

