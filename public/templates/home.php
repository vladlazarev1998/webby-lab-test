<?php echo $header; ?>
    <div class="container mt-3">
        <div class="row">
            <?php foreach ($films as $film) { ?>
                <?php require 'card.php'; ?>
            <?php } ?>
        </div>
    </div>
<?php echo $footer; ?>