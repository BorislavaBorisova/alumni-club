<?php 
    session_start();
    if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
        header( 'Location: /alumni/user/profile.php' );
        exit;
    }

    include('../templates/top.php');
?>

<!--         
<form onsubmit="return successfulLogIn()" method="post">
    Имейл: <input type="text" id="email" name="email"><br>
    Парола: <input type="password" id="password" name="password"><br>
    <div id="error_message"></div>
    <button type="submit">Log in</button>
</form>       -->

<link rel="stylesheet" href="login_style.css">
<script type="text/javascript" defer src="login_ajax.js"></script>

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

<?php
    include('../templates/bottom.php');
?>
