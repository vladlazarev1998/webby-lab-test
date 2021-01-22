<?php echo $header; ?>

<div class="container mt-3">
    <h1 >Редактировать фильм</h1>

    <form action="/film/edit?id=<?php echo $film->id; ?>" method="POST">
        <?php require_once 'form_film.php' ;?>
        <input type="hidden" name="id" value="<?php echo $film->id; ?>">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </form>
</div>

<?php echo $footer;?>
