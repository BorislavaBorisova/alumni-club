<?php
session_start();
session_regenerate_id();

if (!(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)) {
    header('Location: /alumni/login/login_page.php');
    exit;
}

include("../helpers.php");
$user = get_user();

include("../templates/top.php");
?>

<link rel="stylesheet" href="profile_style.css">

<form id="profile-form" name="profile-form" method="POST" action="update.php" enctype="multipart/form-data">
    <img src="<?php echo $user["picture"] ?>" alt="Missing image" />
    <div class="group">
        <label for="picture" class="label">Профилно изображение</label>
        <input class="field" type="file" name="picture" id="picture">
    </div>
    <div class="group">
        <label for="name" class="label">Име</label>
        <input class="field" type="text" name="name" id="name" value="<?php echo $user["name"] ?>">
    </div>
    <div class="group">
        <label for="old-password" class="label">Стара парола</label>
        <input class="field" type="password" name="old-password" id="old-password">
    </div>
    <div class="group">
        <label for="password" class="label">Нова парола</label>
        <input class="field" type="password" name="password" id="password">
    </div>
    <div class="group">
        <label for="repeat-password" class="label">Повторете новата парола</label>
        <input class="field" type="password" name="repeat-password" id="repeat-password">
    </div>
    <div class="group">
        <label for="email" class="label">Email</label>
        <input class="field" type="text" name="email" id="email" value="<?php echo $user["email"] ?>">
    </div>
    <div class="group">
        <label for="place" class="label">Местоживеене</label>
        <input class="field" type="text" name="place" id="place" value="<?php echo $user["place"] ?>">
    </div>
    <div class="group">
        <label for="faculty" class="label">Факултет</label>
        <div class="field" id="faculty"><?php echo $user["faculty"] ?></div>
    </div>
    <div class="group">
        <label for="subject" class="label">Специалност</label>
        <div class="field" id="subject"><?php echo $user["subject"] ?></div>
    </div>
    <div class="group">
        <label for="administrative_group" class="label">Група</label>
        <div class="field" id="administrative_group"><?php echo $user["administrative_group"] ?></div>
    </div>
    <div class="group">
        <label for="year_graduated" class="label">Година на завършване</label>
        <div class="field" id="year_graduated"><?php echo $user["year_graduated"] ?></div>
    </div>
    <button type="submit" class="button">Запази</button>
    <div class="error"><?php if (has_errors()) {
                            echo pop_errors();
                        } ?></div>
</form>

<?php
include("../templates/bottom.php");
?>
