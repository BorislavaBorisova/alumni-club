<?php
    $has_errors = has_errors();

    if($has_errors) {
        $errors = pop_errors();
    }
?>

<?php if($has_errors): ?>
    <ul class="errors-area">
        <h3>Грешки</h3>

        <?php foreach($errors as $error): ?>
            <li class="error">
                <?php echo($error) ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
