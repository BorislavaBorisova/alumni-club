<?php
    $conn = new_db_connection();
    $sql = "SELECT id, year, faculty FROM groups";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $groups = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<h1>Групи</h1>

<form action="/groups/create_group.php" method="post">
    <input type="hidden" name="type" value="year"/>
    <input type="submit" value="Създай група за твоя випуск" />
</form>

<form action="/groups/create_group.php" method="post">
    <input type="hidden" name="type" value="faculty"/>
    <input type="submit" value="Създай група за твоя факултет" />
</form>

<div id="groups">
    <?php foreach($groups as $group): ?>
        <ul>
            <li class="group">
                <?php 
                    if(isset($group['year'])) {
                        printf("<a href='/groups?id=%s'>%s - %s година</a>", $group['id'], $group['faculty'], $group['year']);
                    }
                    else {
                        printf("<a href='/groups?id=%s'>%s</a>", $group['id'], $group['faculty']);
                    }
                ?>
            </li>
        </ul>
    <?php endforeach; ?>
</div>
