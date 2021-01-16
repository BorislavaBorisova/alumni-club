<?php
    $conn = new_db_connection();
    $sql = "SELECT id, year, faculty FROM groups";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $groups = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<h1>Групи</h1>

<div id="groups">
    <?php foreach($groups as $group): ?>
        <ul>
            <li class="group">
                <?php printf("<a href='/groups?id=%s'>%s - %s година</a>", $group['id'], $group['faculty'], $group['year']); ?>
            </li>
        </ul>
    <?php endforeach; ?>
</div>
