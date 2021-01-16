<?php
    function new_db_connection() {
        include('config.php');
        return new PDO('mysql:host=localhost;dbname=alumni_db;charset=utf8', $db_user, $db_pass);
    }
?>
