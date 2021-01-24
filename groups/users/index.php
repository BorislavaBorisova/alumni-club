<?php
    include('../../helpers.php');
    include('../../templates/top.php');

    $group_id = $_GET['id'];

    $conn = new_db_connection();
    $sql = "SELECT id, year, faculty FROM groups WHERE id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $group = $stmt->fetch(PDO::FETCH_ASSOC);

    if(isset($group['year'])) {
        $sql = "SELECT users.id, users.name, users.email FROM users
                JOIN groups ON users.faculty = groups.faculty
                    AND users.year_graduated = groups.year
                WHERE groups.id = ?;";
    }
    else {
        $sql = "SELECT users.id, users.name, users.email FROM users
                JOIN groups ON users.faculty = groups.faculty
                WHERE groups.id = ?;";
    }

    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $users = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<<<<<<< HEAD
<h1>Потребители в група <?php echo($group_id); ?></h1>

<a href="<?php echo("/groups?id=" . $group_id);?>">Назад към групата</a>
=======
<link rel="stylesheet" href="/groups/users/styles.css">

<h1>Потребители в група <?php echo($group_id); ?></h1>

<a id="group-link" href="<?php echo("/groups?id=" . $group_id);?>">Назад към групата</a>
>>>>>>> oops

<div id="users">
    <?php foreach($users as $user): ?>
        <ul>
            <li class="user">
                <?php 
                    echo($user['name'] . " - " . $user['email']);
                ?>
            </li>
        </ul>
    <?php endforeach; ?>
</div>


<?php
    include('../../templates/bottom.php');
?>
