<?php
    function check_for_errors() {
        $user = get_user();
        $group_id = $_POST['group_id'];

        $conn = new_db_connection();
        $stmt = $conn->prepare("SELECT year, faculty FROM groups WHERE id = ?;");
        $stmt->execute([$group_id]);
        $group = $stmt->fetch(PDO::FETCH_ASSOC);

        if(isset($group['year'])) {
            if($user['faculty'] != $group['faculty'] || $user['year_graduated'] != $group['year']) {
                set_errors(Array("Не можеш да създаваш събития в тази група!"));
                return true;
            }
        }
        else {
            if($user['faculty'] != $group['faculty']) {
                set_errors(Array("Не можеш да създаваш събития в тази група!"));
                return true;
            }
        }
        
        return false;
    }

    include("../helpers.php");

    $group_id = $_POST['group_id'];

    if(check_for_errors()) {
        header( 'Location: /alumni/groups?id=' . $group_id );
        return;
    }

    $conn = new_db_connection();
    $stmt = $conn->prepare("INSERT INTO events (title, datetime, description, group_id, user_id)
                            VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$_POST['title'], $_POST['datetime'], $_POST['description'], $group_id, $_POST['user_id']]);

    header( 'Location: /alumni/groups?id=' . $group_id );
?>
