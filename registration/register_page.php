<link rel="stylesheet" href="register_style.css">
<?php 
    session_start();
    if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true || $_SESSION['security_level'] !== 'admin'){
        header( 'Location: /alumni/login/login_page.php' );
        exit;
    }

    include('../templates/top.php');
?>

<div class="create_users_wrap">
    <form action="register_users.php" method="post" enctype="multipart/form-data">
        <h1>Добавяне на нови алумни</h1>
        <p class="description">Качете .csv файл с информацията на алумните, които искате да регистрате.</p>
        <input type="file" id="file" name="file">
        <button type="submit" class="button">Създай</button>
    </form>    
</div>

<?php
    include('../templates/bottom.php');
?>