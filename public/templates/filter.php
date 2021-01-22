<?php echo $header; ?>
    <div class="container mt-3">
        <div class="row">
            <?php if (!empty($films)) { ?>
                <?php foreach ($films as $film) { ?>
                    <?php require 'card.php'; ?>
                <?php } ?>
            <?php } else { ?>
                <h1>Ничего не найдено</h1>
            <?php } ?>
        </div>
    </div>
<?php echo $footer; ?>