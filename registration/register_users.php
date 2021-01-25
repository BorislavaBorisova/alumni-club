<link rel="stylesheet" href="register_style.css">
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
        $default_picture = "data:image/tmp;base64,iVBORw0KGgoAAAANSUhEUgAAAXgAAAF4CAYAAABeneKmAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAxVpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNi1jMDE0IDc5LjE1Njc5NywgMjAxNC8wOC8yMC0wOTo1MzowMiAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgSW1hZ2VSZWFkeSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDo4QjQ0MUY4NzBGREYxMUU2QUI2RkQ3NTE5QjA3REJCRCIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDo4QjQ0MUY4ODBGREYxMUU2QUI2RkQ3NTE5QjA3REJCRCI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjhCNDQxRjg1MEZERjExRTZBQjZGRDc1MTlCMDdEQkJEIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjhCNDQxRjg2MEZERjExRTZBQjZGRDc1MTlCMDdEQkJEIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+NFQZnwAAEcZJREFUeNrs3Y1VG1magOHCZwNgI3BNBFZH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";
        //add default picture
        $stmt = $conn->prepare("INSERT INTO users (email, password, name, security_level, faculty, subject, administrative_group, year_graduated, picture)
                                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$email, $hash, $name, "user", $faculty, $subject, $administrative_group, $year_graduated, $default_picture]);
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
            echo "<p class='message'> Файлът вече съществува. </p>";
            $valid = 0;
        }
        if ($_FILES["file"]["size"] > 600000) {
            echo "<p class='message'> Файлът е твърде голям. </p>";
            $valid = 0;
        }
        if($fileType != "csv") {
            echo "<p class='message'> Позволени са файлове само в CSV формат. </p>";
            $valid = 0;
        }
        return $valid;
    }

    function uploadFile($target_file){
        //print_r($_FILES);
        if (validFile($target_file) === 0) {
            echo "<p class='message'> Файлът ви не е качен. </p>";
        } else {
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                echo "<p class='message'> Файлът ".htmlspecialchars( basename( $_FILES["file"]["name"]))." е успешно качен. </p>";
            } else {
                echo "<p class='message'> Грешка прикачване на файла. Опитайте отново по-късно. </p>";
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
            if(!isset($person[0]) || !isset($person[1]) || !isset($person[2]) || !isset($person[3]) || !isset($person[4]) || !isset($person[5])) return false;
            createProfile($person[1], $password, $person[0], $person[2], $person[3], $person[4], $person[5]);
            sendEmail($person[0], $person[1], $password);
            $person = fgetcsv($file);
        }
        return true;
    }

    $directory = "/xampp/tmp/";
    $target_file = $directory . basename($_FILES["file"]["name"]); 
    uploadFile($target_file);
    if(registerUsers($target_file) === true) echo "<p class='message' id='success_message'>Успешно създадохте профилите.</p>";
    unlink($target_file);
?>



<?php
    include('../templates/bottom.php');
?>
