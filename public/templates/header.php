<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title ?></title>
    <link rel="stylesheet" href="/public/source/style/bootstrap.css">
    <link rel="stylesheet" href="/public/source/style/main.css">
    <?php if($scripts){
        foreach ($scripts as $script) { ?>
            <script src="<?php echo $script?>"></script>
        <?php }
    } ?>

    <?php if($styles){
    foreach ($styles as $style) { ?>
        <link rel="stylesheet" href="<?php echo $style?>">
    <?php }
    } ?>

</head>
<body>
<header class="bg-light">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="/">Webby Lab</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="/">На главную </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/film/add">Добавить фильм</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/import">Импорт фильмов</a>
                    </li>
                </ul>
            </div>
            <div class="float-end">
                <div class="form-outline">
                    <div class="d-flex">
                        <input type="search" id="search" class="form-control placeholder-active" placeholder="Поиск" aria-label="Search">
                        <div class="form-notch">
                            <div class="form-notch-leading" style="width: 9px;"></div>
                            <div class="form-notch-middle" style="width: 0px;"></div>
                            <div class="form-notch-trailing"></div>
                        </div>
                        <button type="button" id="btn_search" class="btn btn-outline-primary ripple-surface">Найти</button>
                    </div>
                </div>
            </div>
        </nav>
    </div>
</header>
  <main>
