<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/rejestracja.css">
    <script type="text/javascript" src="./public/js/script.js" defer></script>
    <title>REGISTRATION PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img id="im" src="public/img/logo.svg">
        </div>
        <div class="reg-container">
            <form action="register" method="POST" class="reg">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="name" type="text" placeholder="imie">
                <input name="surname" type="text" placeholder="nazwisko">
                <input name="nickname" type="text" placeholder="nick">
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="hasło">
                <input name="confirmedPassword" type="password" placeholder="powtórz hasło">
                <button type="submit">REJESTRACJA</button>
            </form>
            <div class="back_to_log">
                <a href="/" ><i id="back"><- </i></a>
            </div>
        </div>
    </div>
</body>