<?php 
    include("../helpers.php");

    function check_for_errors() {
        $user = get_user();
        $post_id = $_POST['post_id'];
        $group_id = $_POST['group_id'];

        $conn = new_db_connection();
        $stmt = $conn->prepare("SELECT user_id FROM posts WHERE id = ?;");
        $stmt->execute([$post_id]);
        $post = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("SELECT admin_id FROM groups WHERE id = ?;");
        $stmt->execute([$group_id]);
        $group = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user['id'] != $post['user_id'] && $user['id'] != $group['admin_id']) {
            set_errors(Array("Не можеш да триеш този пост!"));
            return true;
        }
        
        return false;
    }

    $post_id = $_POST['post_id'];
    $group_id = $_POST['group_id'];

    if(check_for_errors()) {
        header( 'Location: /groups?id=' . $group_id );
        return;
    }

    $conn = new_db_connection();
    $stmt = $conn->prepare("DELETE FROM posts WHERE id = ?");
    $stmt->execute([$post_id]);

    header( 'Location: /groups?id=' . $group_id );
?>
