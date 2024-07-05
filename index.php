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
    <?php require_once 'apps/pagination.php' ?>
    <style>
        .banner__wrapper {
              background-image: url(/images/<?php echo $announceImage ?>);
        }
    </style>
</head>
<body>
    <header class="header">
        <div class="container">
            <a href="#">
                <img class="logo" src="/img/logo.png" alt="GalaxyNews">
            </a>
        </div>
    </header>
    <section class="banner">
        <div class="banner__wrapper">
            <div class="container banner__container">
                <h2 class="banner__title">
                    <?php echo $title ?>
                </h2>
                <p class="banner__descr">
                    <?php echo $announce ?>
                </p>
            </div>
        </div>
    </section>
    <section class="news">
        <div class="container">
            <h1 class="news__title">Новости</h1>
                <?php
                echo '<div class="news__list">';
                foreach ($news as $article) {
                    $article = str_replace('<p>', '', $article);
                    $article = str_replace('</p>', '', $article);
                    echo '<div class="news__item">';
                    echo '<p class="news__data">' . htmlspecialchars($article['news_date']) . '</p>';
                    echo '<h2 class="news__subtitle">' . htmlspecialchars($article['title']) . '</h2>';
                    echo '<p class="news__announce">' . htmlspecialchars($article['announce']) . '</p>';
                    echo '<a class="news__button" href="news.php?id=' . $article['id'] . '">Подробнее <svg class="button__arrow_right" width="26.003967" height="13.321899" viewBox="0 0 26.004 13.3219" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path id="Arrow 1" d="M22.58 5.66L18.63 1.71C18.23 1.31 18.23 0.69 18.63 0.29C19.03 -0.1 19.65 -0.1 20.05 0.29L25.7 5.95C26.1 6.34 26.1 6.97 25.7 7.36L20.05 13.02C19.65 13.42 19.03 13.42 18.63 13.02C18.23 12.62 18.23 12 18.63 11.61L22.58 7.66L0 7.66L0 5.66L22.58 5.66Z" fill="#841844"/>
                        </svg>
                        </a>';
                    echo '</div>';
                }
                echo '</div>';
            
                echo "<div class='pagination'>";
                $page = 1;
                if ($currentPage <= 3) {
                    while ($page <= 3) {
                        echo "<a class='pagination__element' href='?page=$page'>$page</a>";
                        $page++;
                    };
                    echo "<a class='pagination__element' href='?page=$page'><svg class='pagination__arrow' width=\"26.003967\" height=\"13.321899\" viewBox=\"0 0 26.004 13.3219\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                    <defs/>
                    <path id=\"Arrow 1\" d=\"M22.58 5.66L18.63 1.71C18.23 1.31 18.23 0.69 18.63 0.29C19.03 -0.1 19.65 -0.1 20.05 0.29L25.7 5.95C26.1 6.34 26.1 6.97 25.7 7.36L20.05 13.02C19.65 13.42 19.03 13.42 18.63 13.02C18.23 12.62 18.23 12 18.63 11.61L22.58 7.66L0 7.66L0 5.66L22.58 5.66Z\" fill=\"#841844\" fill-opacity=\"1.000000\" fill-rule=\"evenodd\"/>
                    </svg></a>";
                } 
                    else {
                        if ($currentPage > 3 && $currentPage < $totalPages - 2) {
                            $mincount = $currentPage - 1;
                            $maxcount = $currentPage + 1;
                            echo "<a class='pagination__element' href='?page=$page'><svg class='pagination__arrow' width=\"26.003906\" height=\"13.321899\" viewBox=\"0 0 26.0039 13.3219\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                    <defs/>
                    <path id=\"Arrow 1\" d=\"M3.41 5.66L7.36 1.71C7.76 1.31 7.76 0.69 7.36 0.29C6.97 -0.1 6.34 -0.1 5.95 0.29L0.29 5.95C-0.1 6.34 -0.1 6.97 0.29 7.36L5.95 13.02C6.34 13.42 6.97 13.42 7.36 13.02C7.76 12.62 7.76 12 7.36 11.61L3.41 7.66L26 7.66L26 5.66L3.41 5.66Z\" fill=\"#841844\" fill-opacity=\"1.000000\" fill-rule=\"evenodd\"/>
                    </svg></a>";
                            echo "<a class='pagination__element' href='?page=$mincount'>$mincount</a>";
                            echo "<a class='pagination__element' href='?page=$currentPage'>$currentPage</a>";
                            echo "<a class='pagination__element' href='?page=$maxcount'>$maxcount</a>";
                            echo "<a class='pagination__element' href='?page=$totalPages'><svg class='pagination__arrow' width=\"26.003967\" height=\"13.321899\" viewBox=\"0 0 26.004 13.3219\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                    <defs/>
                    <path id=\"Arrow 1\" d=\"M22.58 5.66L18.63 1.71C18.23 1.31 18.23 0.69 18.63 0.29C19.03 -0.1 19.65 -0.1 20.05 0.29L25.7 5.95C26.1 6.34 26.1 6.97 25.7 7.36L20.05 13.02C19.65 13.42 19.03 13.42 18.63 13.02C18.23 12.62 18.23 12 18.63 11.61L22.58 7.66L0 7.66L0 5.66L22.58 5.66Z\" fill=\"#841844\" fill-opacity=\"1.000000\" fill-rule=\"evenodd\"/>
                    </svg></a>";
                    } else { if ($currentPage = ($totalPages - 1)) {
                        $mincount = $currentPage - 1;
                        $maxcount = $currentPage + 1;
                        echo "<a class='pagination__element' href='?page=$page'><svg class='pagination__arrow' width=\"26.003906\" height=\"13.321899\" viewBox=\"0 0 26.0039 13.3219\" fill=\"none\" xmlns=\"http://www.w3.org/2000/svg\" xmlns:xlink=\"http://www.w3.org/1999/xlink\">
                    <defs/>
                    <path id=\"Arrow 1\" d=\"M3.41 5.66L7.36 1.71C7.76 1.31 7.76 0.69 7.36 0.29C6.97 -0.1 6.34 -0.1 5.95 0.29L0.29 5.95C-0.1 6.34 -0.1 6.97 0.29 7.36L5.95 13.02C6.34 13.42 6.97 13.42 7.36 13.02C7.76 12.62 7.76 12 7.36 11.61L3.41 7.66L26 7.66L26 5.66L3.41 5.66Z\" fill=\"#841844\" fill-opacity=\"1.000000\" fill-rule=\"evenodd\"/>
                    </svg></a>";
                        echo "<a class='pagination__element' href='?page=$currentPage'>$currentPage</a>";
                        echo "<a class='pagination__element' href='?page=$maxcount'>$maxcount</a>";
                        }
                    }
                };
                
                echo "</div>";
                ?>

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
</html>

