<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <script src="https://kit.fontawesome.com/9c10ee4fff.js" crossorigin="anonymous"></script>
    <title>ADD PAGE</title>
</head>
<body>
<div class="container2">
    <header>
        <div class="header1">
            <div class="logo2">
                <img id="im2"src="public/img/logo2.svg">
            </div>
            <div class="naj-st">
                <i>Dodaj stok:</i>
            </div>
        </div>
    </header>
    <section class="buttons">
        <div class="hamburger_icon2">
            <a href="#" class="burger_icon">
                <i  class="fas fa-bars extraClass" ></i>
            </a>
        </div>
    </section>
    <section>
        <h1>UPLOAD</h1>
        <form action="addSlope" method="POST" ENCTYPE="multipart/form-data">
            <div class="messages">
                <?php
                if(isset($messages)){
                    foreach($messages as $message) {
                        echo $message;
                    }
                }
                ?>
            </div>
            <input name="title" type="text" placeholder="title">
            <textarea name="description" rows="5" placeholder="description"></textarea>

            <input type="file" name="file"/><br/>
            <button type="submit">send</button>
        </form>
    </section>
</div>
</body>