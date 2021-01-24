<?php
    $has_errors = has_errors();

    if($has_errors) {
        $errors = pop_errors();
    }
?>

<ul class="errors-area">
    <?php if($has_errors): ?>
        <h3>Errors</h3>

        <?php foreach($errors as $error): ?>
            <li class="error">
                <?php echo($error) ?>
            </li>
        <?php endforeach; ?>

        <hr/>
    <?php endif; ?>
</ul>
