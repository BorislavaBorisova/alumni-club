<?php
    $group_id = $_GET['id'];
    $conn = new_db_connection();

    $sql = "SELECT year, faculty FROM groups WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $group = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT content, users.email as user_email FROM posts
            JOIN users ON posts.user_id = users.id
            WHERE posts.group_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $posts = $stmt->fetchALL(PDO::FETCH_ASSOC);
?>

<link rel="stylesheet" href="styles.css">

<h1>
    <?php 
        if(isset($group['year'])) {
            printf("Група за алумни, завършили %s през %s", $group['faculty'], $group['year']);
        }
        else {
            printf("Група за алумни, завършили %s", $group['faculty']);
        }

    ?>
</h2>

<div>
    <?php foreach($posts as $post): ?>
        <div class='post'>
            <div class='user'>
                <?php printf("Публикувано от <i>%s</i>", $post['user_email']); ?>
            </div>
            <div class='content'>
                <blockquote><?php printf("%s", $post['content']); ?></blockquote>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div>
    <form action="/groups/create_post.php" method="post">
        <textarea name="content"></textarea>
        <input type="hidden" name="group_id" value="<?php echo($group_id) ?>"></input>
        <input type="submit" value="Създай"></input>
    </form>
</div>
