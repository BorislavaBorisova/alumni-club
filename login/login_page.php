<?php 
    session_start();
    if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
        header( 'Location: /alumni/user_profile.php' );
        exit;
    }
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
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js" type="text/javascript"></script>
<div id="picture">
    <form method="post" onsubmit="return successfulLogIn(event)"> 
        <div class="box">
            <h1>Вход в клуба</h1>
            <input type="email" name="email" class="email" id="email" placeholder="Имейл"/>
            <input type="password" name="password" class="password" id="password" placeholder="Парола"/>   
            <input type="submit" class="button" value="Вход"/>
            <p><a href="">Забравена парола</a></p> 
            <div id="error_message"></div>
        </div>
    </form>
</div>
