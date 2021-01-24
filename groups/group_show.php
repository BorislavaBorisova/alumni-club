<?php
    $group_id = $_GET['id'];
    $conn = new_db_connection();

    $sql = "SELECT id, year, faculty, admin_id FROM groups WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $group = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT posts.id as id, posts.content as content, user_id, users.email as user_email FROM posts
            JOIN users ON posts.user_id = users.id
            WHERE posts.group_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $posts = $stmt->fetchALL(PDO::FETCH_ASSOC);

    $sql = "SELECT events.id as id, title, datetime, description, user_id, users.email as user_email FROM events
            JOIN users ON events.user_id = users.id
            WHERE group_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$group_id]);
    $events = $stmt->fetchALL(PDO::FETCH_ASSOC);

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
</h1>

<a id="group-users-link" href="<?php echo("/groups/users?id=" . $group_id);?>">Виж кой е в тази група</a>

<?php include("../templates/errors.php"); ?>

<div id="posts">
    <h2>Постове</h2>
    <?php foreach($posts as $post): ?>
        <div class='post'>
            <div class='user'>
                <?php printf("Публикувано от <i>%s</i>", $post['user_email']); ?>
            </div>
            <div class='content'>
                <blockquote><?php printf("%s", $post['content']); ?></blockquote>
            </div>
            <?php if($group['admin_id'] == $user['id'] || $post['user_id'] == $user['id']): ?>
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

    <div>
        <form action="/groups/create_post.php" method="post" id="create-post">
            <textarea name="content" class="content"></textarea>
            <input type="hidden" name="group_id" value="<?php echo($group_id) ?>"></input>
            <input type="submit" value="Създай" class="submit"></input>
        </form>
    </div>
</div>

<div id="events-right">
    <div id="events">
        <h2>Събития</h2>
        <?php foreach($events as $event): ?>
            <div class='event'>
                <div class='user'>
                    <?php printf("Създадено от <i>%s</i>", $event['user_email']); ?>
                </div>
                <div class='title'>
                    <b><?php echo($event['title']); ?></b>
                </div>
                <div class='description'>
                    <blockquote><?php echo($event['description']); ?></blockquote>
                </div>
                <div class='datetime'>
                    Кога: <?php echo($event['datetime']); ?>
                </div>

                <?php if($group['admin_id'] == $user['id'] || $event['user_id'] == $user['id']): ?>
                    <div class='admin-controls'>
                        <form action="/groups/delete_event.php" method="post">
                            <input type="hidden" name="event_id" value="<?php echo($event['id']); ?>"/>
                            <input type="hidden" name="group_id" value="<?php echo($group['id']); ?>"/>
                            <input type="submit" value="Изтрий" />
                        </form>
                    </div>
                <?php endif ?>
            </div>
        <?php endforeach; ?>
    </div>

    <div id="create-event">
        <h3>Създай събитие</h3>
        <form action="/groups/create_event.php" method="post">
            <input type="hidden" name="group_id" value="<?php echo($group_id) ?>"></input>
            <input type="hidden" name="user_id" value="<?php echo($user['id']) ?>"></input>
            <div>
                <label>Заглавие</label>
                <input type="text" name="title"></input>
            </div>
            <div>
                <label>Време</label>
                <input type="datetime-local" name="datetime"></input>
            </div>
            <div>
                <label>Описание</label>
                <textarea name="description"></textarea>
            </div>
            <input class="submit" type="submit" value="Създай"></input>
        </form>
    </div>
</div>
