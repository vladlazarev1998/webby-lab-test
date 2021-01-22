<?php echo $header; ?>
    <div class="container mt-3">
        <div class="row">
            <h1><?php echo $film->title; ?></h1>
            <h2>Дата релиза <?php echo $film->release_date; ?></h2>

            <?php if(!$film->actors->isEmpty()){ ?>
                <h3>Формат <?php echo $film->format->title; ?></h3>
                Авторы :
                <?php foreach ($film->actors as $actor) { ?>
                    <p><?php echo $actor->name; ?></p>
                <?php } ?>
            <?php } ?>

        </div>
    </div>
<?php echo $footer; ?>