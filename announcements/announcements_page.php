<link rel="stylesheet" href="announcements_style.css">
<?php 
    include("../templates/top.php");
?>

<div class="container">
    <div class="box">
        <form method="post" action="add_announcement.php" id="announcement_form"> 
            <h2 id="form_title">Добави обява</h2>
            <p id="description">Напиши темата и опиши накратко целта на обявата.</p>
            <input type="text" name="title" class="input" id="title" placeholder="Заглавие"/>   
            <input type="text" name="description" class="input" id="description" placeholder="Описание..."/>
            <input type="submit" class="button" value="Добави"/>
            <?php 
                if(isset($_GET['success']) && $_GET['success'] === "false"){
                    echo "<div id=\"error_message\">Настъпи проблем при качване на обявата. Опитайте отново.</div>";
                }
            ?>
        </form>
        
        <!-- cols="35"  -->
    </div>
    <div class="announcements">
        <?php 
            include("../helpers.php");
            $conn = new_db_connection();
            $sql = "SELECT users.email, title, description FROM announcements JOIN users ON users.id=announcements.author_id";
            $stmt = $conn->prepare($sql);
            $stmt->execute();
            while($announcement = $stmt->fetch(PDO::FETCH_ASSOC)){
                echo "<h2> ".$announcement['title']. "</h2>"; 
                echo "<p class='title'> ".$announcement['description']. "</p>";
                echo "<p class='author'> От ".$announcement['email']. "</p>";
                echo "<hr>";
            } 
        ?>
    </div>
</div>

<?php 
    include("../templates/bottom.php");
?>
