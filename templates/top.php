<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Алумни клуб</title>
        <style> @import url('https://fonts.googleapis.com/css2?family=Rubik&display=swap'); </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <link rel="stylesheet" href="/templates/styles.css">
    </head>
    <body>
        <div id="navigation">
            <a href="/alumni/groups">Групи</a>
            <a href="/alumni/user_profile.php">Профил</a>
            <a href="/alumni/login/login_page.php">Влизане</a>
            <?php
                if(isset($_SESSION['security_level']) && $_SESSION['security_level'] === "admin"){
                    echo "<a href=\"/alumni/registration/register_page.php\">Добави алумни</a>";
                }
            ?>
            <a href="/alumni/logout/logout.php">Изход</a>
        </div>
        <div id='container'>