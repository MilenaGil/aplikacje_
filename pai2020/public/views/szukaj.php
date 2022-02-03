<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/szukaj.css">
    <script src="https://kit.fontawesome.com/9c10ee4fff.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="./public/js/search.js" defer></script>

    <title>FIND PAGE</title>
</head>
<body>
<div class="container6">
    <header>
        <div class="header1">
            <div class="logo2">
                <img id="im2"src="public/img/logo2.svg">
            </div>
            <div class="search-bar2">
                <input name="rejon" type="text" placeholder="Rejon lub nazwa stoku">
            </div>
        </div>
    </header>
    <div class="buttons">
        <div class="hamburger_icon2">
            <a href="#" class="burger_icon">
                <i  class="fas fa-bars extraClass" ></i>
            </a>
        </div>
    </div>
    <section class="slopes">
        <?php foreach($slopes as $slope): ?>
            <div>
                <img src="public/uploads/<?= $slope->getImage(); ?>">
                <div>
                    <h2><?= $slope->getTitle(); ?></h2>
                    <p><?= $slope->getDescription(); ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </section>
</div>
</body>

<template id="slope-template">
    <div>
        <img src="">
        <div>
            <h2>title</h2>
            <p>description</p>
        </div>
    </div>
</template>