<?php
    session_start();
    include("../helpers.php");

    $type = $_POST['type'];


    $conn = new_db_connection();

    // Get user year and faculty
    $stmt = $conn->prepare("SELECT year_graduated as year, faculty FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    print_r($user);

    // Create his group
    $stmt = $conn->prepare("INSERT INTO groups (year, faculty)
                            VALUES (?, ?)");

    switch($type) {
        case 'faculty':
            $stmt->execute([null, $user['faculty']]);
            break;
        case 'year':
            $stmt->execute([$user['year'], $user['faculty']]);
            break;
        default:
            print_r("Error: Unknown group creation type!");
            break;
    }

    header( 'Location: /groups' );
?>
