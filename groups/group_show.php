<?php
    $group_id = $_GET['id'];
    $conn = new_db_connection();

    $sql = "SELECT id, year, faculty, admin_id FROM groups WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $group = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT posts.id as id, posts.content as content, users.email as user_email FROM posts
            JOIN users ON posts.user_id = users.id
            WHERE posts.group_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $posts = $stmt->fetchALL(PDO::FETCH_ASSOC);

    $user = get_user();
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
            <?php if($group['admin_id'] == $user['id']): ?>
                <div class='admin-controls'>
                    <form action="/groups/delete_post.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo($post['id']); ?>"/>
                        <input type="hidden" name="group_id" value="<?php echo($group['id']); ?>"/>
                        <input type="submit" value="Изтрий" />
                    </form>
                </div>
            <?php endif ?>
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
