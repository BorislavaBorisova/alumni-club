<?php 
    include('../common.php');

    session_start();
    if(isset($_SESSION["logged"]) && $_SESSION["logged"] === true){
        header( 'Location: http://localhost/alumni/user_profile.php' );
        exit;
    }
    //check if it is json
    $data = json_decode(file_get_contents('php://input'), true);
    $conn = new_db_connection();
    $sql = "SELECT id, email, password, security_level FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$data['email']]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
    if(password_verify($data['password'], $row['password']) == true){                                      
        $_SESSION['logged'] = true;
        $_SESSION['id'] = $row['id'];
        $_SESSION['email'] = $row['email'];                            
        $success = true;
        echo json_encode(array("success"=>$success));
    } else {
        $success = false;
        $error_message = "Грешен имейл или парола.";
        session_destroy();
        echo json_encode(array("success"=>$success, "error_message"=>$error_message));
    }

    // if($row['security_level'] == "user"){
    //     header( 'Location: http://localhost/ex2-formSQL/electives_form.php' ) ;
    //     exit;
    // } else {
    //     header( 'Location: http://localhost/ex2-formSQL/homepage.php' ) ;
    //     exit;
    // }
?>

