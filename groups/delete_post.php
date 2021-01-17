<?php 
    include("../helpers.php");

    $post_id = $_POST['post_id'];
    $group_id = $_POST['group_id'];

    $conn = new_db_connection();
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);

    header( 'Location: /groups?id=' . $group_id );
?>
