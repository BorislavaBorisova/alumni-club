<?php
    include('../helpers.php');
    include('../templates/top.php');

    if(isset($_GET['id'])) {
        include('group_show.php');
    }
    else {
        include('groups_list.php');
    }

    include('../templates/bottom.php');
?>
