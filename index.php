<?php
    include('./helpers.php');
    include('./config.php');

    function tableExists($pdo, $table) {

        // Try a select statement against the table
        // Run it in try-catch in case PDO is in ERRMODE_EXCEPTION.
        try {
            $result = $pdo->query("SELECT 1 FROM {$table} LIMIT 1");

        } catch (Exception $e) {
            // We got an exception (table not found)

            return FALSE;
        }

        // Result is either boolean FALSE (no table found) or PDOStatement Object (table found)
        return $result !== FALSE;
    }
    
    if (tableExists(new_db_connection_without_table(), $db_name) === FALSE) {
        $sql = file_get_contents('.\81637_81621_81714_init_db.sql');
        new_db_connection_without_table()->exec($sql);
    }

    header( 'Location: /alumni/login/login_page.php' );
?>
