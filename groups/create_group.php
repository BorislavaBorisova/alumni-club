<?php
    function check_for_errors() {
        $conn = new_db_connection();
        $type = $_POST['type'];
        $user = get_user();

        switch($type) {
            case 'faculty':
                $stmt = $conn->prepare("SELECT year, faculty FROM groups WHERE faculty = ? AND year is NULL");
                $stmt->execute([$user['faculty']]);
                break;
            case 'year':
                $stmt = $conn->prepare("SELECT year, faculty FROM groups WHERE year = ? AND faculty = ?");
                $stmt->execute([$user['year_graduated'], $user['faculty']]);
                break;
            default:
                set_errors(Array("Сървърна грешка: Неизвестен тип на създаване на група"));
                return true;
        }

        $group = $stmt->fetch(PDO::FETCH_ASSOC);

        if($group) {
            set_errors(Array("Групата вече съществува"));
            return true;
        }

        return false;
    }

    include("../helpers.php");

    $type = $_POST['type'];
    $user = get_user();

    if(check_for_errors()) {
        header( 'Location: /alumni/groups' );
        return;
    }

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

    header( 'Location: /alumni/groups' );
?>
