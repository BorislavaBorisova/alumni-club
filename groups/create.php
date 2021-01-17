<?php
    include("../helpers.php");

    $type = $_POST['type'];

    $user = get_user();

    $conn = new_db_connection();
    $stmt = $conn->prepare("INSERT INTO groups (year, faculty, admin_id)
                            VALUES (?, ?, ?)");

    switch($type) {
        case 'faculty':
            $stmt->execute([null, $user['faculty'], $user['id']]);
            break;
        case 'year':
            $stmt->execute([$user['year_graduated'], $user['faculty'], $user['id']]);
            break;
        default:
            print_r("Error: Unknown group creation type!");
            break;
    }

    header( 'Location: /groups' );
?>
