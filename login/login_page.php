<?php 
    session_start();
    if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
        header( 'Location: http://localhost/alumni/user_profile.php' );
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Алумни клуб</title>
        <style> @import url('https://fonts.googleapis.com/css2?family=Rubik&display=swap'); </style>
        <link rel="stylesheet" href="login_style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script type="text/javascript" defer src="login_ajax.js"></script>
    </head>
    <body>
<!--         
        <form onsubmit="return successfulLogIn()" method="post">
            Имейл: <input type="text" id="email" name="email"><br>
            Парола: <input type="password" id="password" name="password"><br>
            <div id="error_message"></div>
            <button type="submit">Log in</button>
        </form>       -->

        <div class="login-wrap">
        <div class="login-html">
            <input id="tab-1" type="radio" name="tab" class="sign-in" checked><label for="tab-1" class="tab">Вход в Клуба</label>
            <input id="tab-2" type="radio" name="tab" class="sign-up"><label for="tab-2" class="tab"></label>
            <div class="login-form">
                <div class="sign-in-htm">
                    <form onsubmit="return successfulLogIn()" method="post">
                        <div class="group">
                            <label for="user" class="label">Имейл</label>
                            <input type="text" id="email" name="email" class="input">
                        </div>
                        <div class="group">
                            <label for="pass" class="label">Парола</label>
                            <input type="password" class="input" data-type="password" id="password" name="password">
                        </div>
                        <div class="group">
                            <!-- <input type="submit" class="button" value="Log In"> -->
                            <button type="submit" class="button">Вход</button>
                            <div id="error_message"></div>
                        </div>
                        <div class="hr"></div>
                        <div class="foot-lnk">
                            <a href="#forgot">Забравена парола</a>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>
    </body>
</html>