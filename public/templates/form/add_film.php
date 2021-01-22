<?php echo $header; ?>

<div class="container mt-3">
    <h1 >Добавить фильм</h1>

    <form action="/film/add" method="POST">
        <?php require_once 'form_film.php' ;?>
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>

<?php echo $footer;?>
