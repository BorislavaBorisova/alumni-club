<?php
session_start();

if (!(isset($_SESSION["logged"]) && $_SESSION["logged"] === true)) {
    header('Location: /alumni/login/login_page.php');
    exit;
}

include("../helpers.php");

$user = get_user_by_email($_GET["email"]);

include("../templates/top.php");
?>

<link rel="stylesheet" href="profile_style.css">

<div id="profile-form">
    <img src="<?php echo $user["picture"] ?>" alt="Missing image" />
    <div class="group">
        <label for="name" class="label">Име</label>
        <div class="field" id="name"><?php echo prepare_string_for_print($user["name"]) ?></div>
    </div>
    <div class="group">
        <label for="email" class="label">Email</label>
        <div class="field" id="email"><?php echo prepare_string_for_print($user["email"]) ?></div>
    </div>
    <div class="group">
        <label for="place" class="label">Местоживеене</label>
        <div class="field" id="place"><?php echo prepare_string_for_print($user["place"]) ?></div>
    </div>
    <div class="group">
        <label for="faculty" class="label">Факултет</label>
        <div class="field" id="faculty"><?php echo prepare_string_for_print($user["faculty"]) ?></div>
    </div>
    <div class="group">
        <label for="subject" class="label">Специалност</label>
        <div class="field" id="subject"><?php echo prepare_string_for_print($user["subject"]) ?></div>
    </div>
    <div class="group">
        <label for="administrative_group" class="label">Група</label>
        <div class="field" id="administrative_group"><?php echo prepare_string_for_print($user["administrative_group"]) ?></div>
    </div>
    <div class="group">
        <label for="year_graduated" class="label">Година на завършване</label>
        <div class="field" id="year_graduated"><?php echo prepare_string_for_print($user["year_graduated"]) ?></div>
    </div>
</div>

<?php
include("../templates/bottom.php");
?>
