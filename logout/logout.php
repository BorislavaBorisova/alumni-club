<?php 
    session_start();
    session_destroy();
    header( 'Location: /alumni/login/login_page.php' );
    exit;
?>