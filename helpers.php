<?php
    function new_db_connection() {
        include('config.php');
        return new PDO('mysql:host=' . $db_host . ';port=' . $db_port . ';dbname=' . $db_name . ';charset=utf8', $db_user, $db_pass);
    }

    function new_db_connection_without_table() {
        include('config.php');
        return new PDO('mysql:host=' . $db_host . ';port=' . $db_port, $db_user, $db_pass);
    }

    // Start session only if one isn't started yet
    function safe_session_start() {
        if(session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    function get_user() {
        safe_session_start();

        $conn = new_db_connection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$_SESSION['id']]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function get_user_by_id($id) {
        safe_session_start();

        $conn = new_db_connection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function get_user_by_email($email) {
        safe_session_start();

        $conn = new_db_connection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Used for debugging purposes mostly
    function set_user($id) {
        safe_session_start();

        $conn = new_db_connection();
        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        $_SESSION['logged'] = true;
        $_SESSION['id'] = $id;
        $_SESSION['email'] = $user['email'];
    }

    function set_errors($errors) {
        safe_session_start();
        $_SESSION['errors'] = $errors;
    }

    function has_errors() {
        safe_session_start();
        return isset($_SESSION['errors']);
    }

    function pop_errors() {
        safe_session_start();
        $errors = $_SESSION['errors'];
        $_SESSION['errors'] = null;
        return $errors;
    }

    function prepare_string_for_print($str) {
        if(preg_match('/^.+$/', $str)) return $str;
        return "-";
    }
?>
