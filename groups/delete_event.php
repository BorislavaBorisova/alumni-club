<?php 
    include("../helpers.php");

    $event_id = $_POST['event_id'];
    $group_id = $_POST['group_id'];

    $conn = new_db_connection();
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->execute([$event_id]);

    header( 'Location: /groups?id=' . $group_id );
?>
