<!DOCTYPE html>
<head>
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
    <title>LOGIN PAGE</title>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img id="im" src="public/img/logo.svg">
        </div>
        <div class="login-container">
            <form class="login" action="login" method="POST">
                <div class="messages">
                    <?php
                    if(isset($messages)){
                        foreach($messages as $message) {
                            echo $message;
                        }
                    }
                    ?>
                </div>
                <input name="email" type="text" placeholder="email@email.com">
                <input name="password" type="password" placeholder="hasło">
                <button id="log_b" type="submit">ZALOGUJ</button>
            </form>
            <form class="rej" action="rejestracja" method="POST">
                <button id="rej_b" type="submit">REJESTRACJA</button>
            </form>
        </div>
    </div>
</body>