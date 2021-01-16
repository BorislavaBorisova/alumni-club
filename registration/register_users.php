<?php 
    include('../common.php');

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

    function registerUsers($fileName){
        $file = fopen($fileName, "r");
        $person = fgetcsv($file);
        while($person){       
            $password = base64_encode(random_bytes(10));
            echo $password." ";
            //print_r($person);
            //expected order in csv file: name, email, faculty, subject, administrative_group, year_graduated
            //TODO add default picture
            createProfile($person[1], $password, $person[0], $person[2], $person[3], $person[4], $person[5]);
            sendEmail($person[0], $person[1], $password);
            $person = fgetcsv($file);
        }
    }

    registerUsers($_GET['file_name']);
?>
