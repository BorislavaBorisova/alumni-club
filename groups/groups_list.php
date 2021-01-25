<?php
    $conn = new_db_connection();

    $user = get_user();

    $sql = "SELECT id, year, faculty FROM groups WHERE (year IS NULL AND faculty=?) OR (year=? AND faculty=?);";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$user['faculty'], $user['year_graduated'], $user['faculty']]);
    $groups = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="/alumni/groups/group_list_styles.css">

<h1>Групи</h1>

<form class="create-group" action="/alumni/groups/create_group.php" method="post">
    <input type="hidden" name="type" value="year"/>
    <input class="submit" type="submit" value="Създай група за твоя випуск" />
</form>

<form class="create-group" action="/alumni/groups/create_group.php" method="post">
    <input type="hidden" name="type" value="faculty"/>
    <input class="submit" type="submit" value="Създай група за твоя факултет" />
</form>

<?php include("../templates/errors.php"); ?>

<div id="groups">
    <?php foreach($groups as $group): ?>
        <ul>
            <li class="group">
                <?php 
                    if(isset($group['year'])) {
                        printf("<a href='/alumni/groups?id=%s'>%s - %s година</a>", $group['id'], $group['faculty'], $group['year']);
                    }
                    else {
                        printf("<a href='/alumni/groups?id=%s'>%s</a>", $group['id'], $group['faculty']);
                    }
                ?>
            </li>
        </ul>
    <?php endforeach; ?>
</div>
