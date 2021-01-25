<?php 
    include('../helpers.php');

    session_start();
    if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
        header( 'Location: http://localhost/alumni/user/profile.php' );
        exit;
    }
    //check if it is json
    $data = json_decode(file_get_contents('php://input'), true);
    $conn = new_db_connection();
    $sql = "SELECT id, email, password, security_level FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$data['email']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
    if(isset($row['password']) && password_verify($data['password'], $row['password']) === true){                                      
        $_SESSION['logged'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];  
        $_SESSION['security_level'] = $row['security_level'];                            
        $success = true;
        echo json_encode(array("success"=>$success));
    } else {
        $success = false;
        $error_message = "Грешен имейл или парола.";
        session_destroy();
        echo json_encode(array("success"=>$success, "error_message"=>$error_message));
    }
?>

