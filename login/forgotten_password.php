<?php
session_start();
if (isset($_SESSION["logged"]) && $_SESSION["logged"] === true) {
    header('Location: /alumni/user/profile.php');
    exit;
}

include("../helpers.php");

if (isset($_POST["email"])) {
    $password = base64_encode(random_bytes(10));

    $conn = new_db_connection();
    $sql = "UPDATE users
    SET password = ?
    WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([password_hash($password, PASSWORD_DEFAULT), $_POST["email"]]);

    $subject = 'Смяна на паролата';
    $message = 'Поискана беше нова парола за вашия акаунт в Клуба на Алумните на СУ' . "\r\n" .
        'Новата ви парола е:' . "\r\n" .
        $password . "\r\n";

    $headers = 'From: alumni_club@sofia.uni.com';

    mail($_POST["email"], $subject, $message, $headers);

    header('Location: /alumni/login/login_page.php');
}
?>


<link rel="stylesheet" href="login_style.css">
<div id="picture">
    <form method="post" action="/alumni/login/forgotten_password.php">
        <div class="box">
            <h1>Въведете имейла</h1>
            <input type="email" name="email" class="email" id="email" placeholder="Имейл" />
            <input type="submit" class="button" value="Изпрати нова парола" />
        </div>
    </form>
</div>
