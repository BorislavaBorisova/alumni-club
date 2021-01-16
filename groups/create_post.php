<?php
    include("../helpers.php");

    print_r($_POST);
    $group_id = $_POST['group_id'];
    $content = $_POST['content'];

    $user = get_user();

    $conn = new_db_connection();
    $stmt = $conn->prepare("INSERT INTO posts (group_id, user_id, content)
                            VALUES (?, ?, ?)");
    $stmt->execute([$_POST['group_id'], $user['id'], $_POST['content']]);

    header( 'Location: /groups?id=' . $group_id );
?>