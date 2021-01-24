<?php
    include("../helpers.php");

    function check_for_errors() {
        $user = get_user();
        $group_id = $_POST['group_id'];

        $conn = new_db_connection();
        $stmt = $conn->prepare("SELECT year, faculty FROM groups WHERE id = ?;");
        $stmt->execute([$group_id]);
        $group = $stmt->fetch(PDO::FETCH_ASSOC);

        if(isset($group['year'])) {
            if($user['faculty'] != $group['faculty'] || $user['year_graduated'] != $group['year']) {
                set_errors(Array("Не можеш да постваш в тази група!"));
                return true;
            }
        }
        else {
            if($user['faculty'] != $group['faculty']) {
                set_errors(Array("Не можеш да постваш в тази група!"));
                return true;
            }
        }
        
        return false;
    }

    $group_id = $_POST['group_id'];
    $content = $_POST['content'];

    if(check_for_errors()) {
        header( 'Location: /groups?id=' . $group_id );
        return;
    }

    $user = get_user();

    $conn = new_db_connection();
    $stmt = $conn->prepare("INSERT INTO posts (group_id, user_id, content)
                            VALUES (?, ?, ?)");
    $stmt->execute([$_POST['group_id'], $user['id'], $_POST['content']]);

    header( 'Location: /groups?id=' . $group_id );
?>