<?php
session_start();
session_regenerate_id();

if (!(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)) {
    header('Location: /alumni/login/login_page.php');
    exit;
}

include("../helpers.php");

$conn = new_db_connection();
$sql = "SELECT password, picture FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->execute([$_SESSION["id"]]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$errors = "";

$name = $_POST["name"];
$oldPassword = $_POST["old-password"];
$password = $_POST["password"];
$repeatPassword = $_POST["repeat-password"];
$email = $_POST["email"];
$place = $_POST["place"];

if (isset($password) && $password !== "") {
    if (!password_verify($oldPassword, $row['password'])) {
        $errors .= "Грешна парола.\n";
    } else if ($password !== $repeatPassword) {
        $errors .= "Повторената парола не съвпада.\n";
    } else if (!preg_match('/^.{8,}$/', $password)) {
        $errors .= "Паролата трябва да има поне 8 символа.\n";
    }
}

if ($errors !== "") {
    set_errors($errors);
} else {
    $base64 = $row['picture'];
    if(isset($_FILES['picture']) && $_FILES['picture']['tmp_name'] !== ""){
        $file_tmp = $_FILES['picture']['tmp_name'];
        $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
        $data = file_get_contents($file_tmp);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
    }

    $sql = "UPDATE users
    SET name = ?, password = ?, email = ?, place = ?, picture = ?
    WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name, password_hash($password, PASSWORD_DEFAULT), $email, $place, $base64, $_SESSION["id"]]);
}

header('Location: /alumni/user/profile.php');
exit;
