<?php 
    session_start();
    if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true){
        header( 'Location: /alumni/login/login_page.php' );
        exit;
    }

    include('../templates/top.php');

    include('../helpers.php');

    $conn = new_db_connection();
    $stmt = $conn->prepare("INSERT INTO announcements VALUES (?, ?, ?);");
    safe_session_start();
    
    $response = $stmt->execute([$_SESSION['id'], $_POST['title'], $_POST['description']]);
    // echo $_SESSION['id']. $_POST['title']. $_POST['description'].$response."jik" ;
    // exit;
    // if($response === true){
    header( 'Location: /alumni/announcements/announcements_page.php' );
    // } else {
    //     header( 'Location: /alumni/announcements/announcements_page.php?success=false' );
    // }
?>