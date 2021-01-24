<?php
    session_start();
    if(!isset($_SESSION["logged"]) || $_SESSION["logged"] !== true || $_SESSION['security_level'] !== 'admin'){
        header( 'Location: /alumni/login/login_page.php' );
        exit;
    }

    include('../templates/top.php');
    include('../helpers.php');

    function createProfile($email, $password, $name, $faculty, $subject, $administrative_group, $year_graduated){
        $conn = new_db_connection();
        $hash = password_hash($password, PASSWORD_DEFAULT);
        //add default picture
        $stmt = $conn->prepare("INSERT INTO users (email, password, name, security_level, faculty, subject, administrative_group, year_graduated)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$email, $hash, $name, "user", $faculty, $subject, $administrative_group, $year_graduated]);
        $rows = $stmt->fetchALL(PDO::FETCH_NUM);
    }

    function sendEmail($name, $email, $password){
        $subject = 'Клуб на Алумните на СУ';
        $message = 'Здравей '.$name.','."\r\n".
                    'Честито завършване и добре дошъл/а в Клуба на Алумните на СУ!'."\r\n".
                    'За да влезеш в профила си използвай този имейл адрес и следната парола: '.$password. '.'."\r\n".
                    'В клуба може да общуваш с колеги от различни специалности, да организираш събития и др.'."\r\n".
                    'На добър час!'."\r\n".
                    'Екипа на Клуба на Алумните на СУ'."\r\n";
        $headers = 'From: alumni_club@sofia.uni.com';
        mail($email, $subject, $message, $headers);
    }

    function validFile($target_file){
        $valid = 1;
        $fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (file_exists($target_file)) {
            echo "This file already exists.";
            $valid = 0;
        }
        if ($_FILES["file"]["size"] > 600000) {
            echo "This file is too large.";
            $valid = 0;
        }
        if($fileType != "csv") {
            echo "Only CSV files are allowed.";
            $valid = 0;
        }
        return $valid;
    }

    function uploadFile($target_file){
        print_r($_FILES);
        if (validFile($target_file) === 0) {
            echo "Your file was not uploaded.";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["file"]["name"])). " has been uploaded.";
            } else {
                echo "There was an error uploading your file. Try again later.";
            }
        }
    }

    function registerUsers($target_file){
        $file = fopen($target_file, "r");
        $person = fgetcsv($file);
        while($person){       
            $password = base64_encode(random_bytes(10));
            //echo $password." ";
            //print_r($person);
            //expected order in csv file: name, email, faculty, subject, administrative_group, year_graduated
            //TODO add default picture
            createProfile($person[1], $password, $person[0], $person[2], $person[3], $person[4], $person[5]);
            sendEmail($person[0], $person[1], $password);
            $person = fgetcsv($file);
        }
    }

    $directory = "/xampp/tmp/";
    $target_file = $directory . basename($_FILES["file"]["name"]); 
    uploadFile($target_file);
    registerUsers($target_file);
    unlink($target_file);

    include('../templates/bottom.php');
?>
