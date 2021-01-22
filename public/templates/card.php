<div class="col-sm-3 mt-3">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?php echo $film->title;?></h5>
            <p class="card-text">Год выпуска - <?php echo $film->release_date;?></p>

            <?php if(!$film->actors->isEmpty()){ ?>
                <h6>Авторы</h6>
                <?php foreach ($film->actors as $actor) { ?>
                    <p>
                        <?php echo $actor->name; ?>
                    </p>
                <?php } ?>
            <?php } ?>

            <div class="row">
                <a href="/film?id=<?php echo $film->id;?>" class="btn btn-success">На страницу фильма</a>
            </div>
            <div class="row">
                <a href="/film/edit?id=<?php echo $film->id;?>" class="btn btn-primary mt-3">Редактировать</a>
            </div>
            <form action="/film/delete" method="POST" class="mt-3">
                <input type="hidden" value="<?php echo $film->id;?>" name="id">
                <div class="row">
                    <button type="submit" onclick="if (confirm('Удалить фильм?')) { return true;}else {return false}" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>