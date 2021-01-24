<?php
    include("../helpers.php");

    $group_id = $_POST['group_id'];

    $conn = new_db_connection();
    $stmt = $conn->prepare("INSERT INTO events (title, datetime, description, group_id, user_id)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['datetime'], $_POST['description'], $group_id, $_POST['user_id']]);

    header( 'Location: /groups?id=' . $group_id );
?>
