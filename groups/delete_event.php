<?php 
    function check_for_errors() {
        $user = get_user();
        $group_id = $_POST['group_id'];
        $event_id = $_POST['event_id'];

        $conn = new_db_connection();
        $stmt = $conn->prepare("SELECT user_id FROM events WHERE id = ?;");
        $stmt->execute([$event_id]);
        $event = $stmt->fetch(PDO::FETCH_ASSOC);

        $stmt = $conn->prepare("SELECT admin_id FROM groups WHERE id = ?;");
        $stmt->execute([$group_id]);
        $group = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user['id'] != $event['user_id'] && $user['id'] != $group['admin_id']) {
            set_errors(Array("Не можеш да триеш събития в тази група!"));
            return true;
        }
        
        return false;
    }

    include("../helpers.php");

    $event_id = $_POST['event_id'];
    $group_id = $_POST['group_id'];

    if(check_for_errors()) {
        header( 'Location: /alumni/groups?id=' . $group_id );
        return;
    }

    $conn = new_db_connection();
    $stmt = $conn->prepare("DELETE FROM events WHERE id = ?");
    $stmt->execute([$event_id]);

    header( 'Location: /alumni/groups?id=' . $group_id );
?>
