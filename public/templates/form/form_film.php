<div class="form-group">
    <label for="title">Название</label>
    <input type="text" class="form-control" name="title" id="title" placeholder="Введите название" <?php if (isset($film)) { ?> value="<?php echo $film->title; ?>" <?php  } ?> required>
</div>
<div class="form-group">
    <label for="release_date">Год выпуска</label>
    <input type="text" class="form-control" name="release_date" id="release_date" placeholder="Введите год выпуска" <?php if (isset($film)) { ?> value="<?php echo $film->release_date; ?>" <?php  } ?> required>
</div>
<div class="form-group">
    <label for="format_id">Формат фильма</label>
    <select name="format_id" class="form-control" id="format_id" required>
        <?php foreach ($formats as $format) { ?>
            <?php if (isset($film)) { ?>
               <?php if ($format->id == $film->format_id) { ?>
                    <option selected value="<?php echo $format->id; ?>"><?php echo $format->title; ?></option>
               <?php } ?>
            <?php  } ?>
            <option value="<?php echo $format->id; ?>"><?php echo $format->title; ?></option>
        <?php } ?>
    </select>
</div>
<?php
    if (isset($film)) {
        $val_actors = [];
        foreach ($film->actors as $actor) {
            $val_actors[] = $actor->name;
        }
        $actors = implode(',', $val_actors);
    }
?>
<div class="form-group">
    <label for="actors">Актеры</label>
    <input type="text" class="form-control" name="actors" id="actors" placeholder="Введите актеров" <?php if (isset($film)) { ?> value="<?php echo $actors; ?>" <?php  } ?> required>
    <small class="form-text text-muted">Перечислять через кому.</small>
</div>

<?php if(!empty($errors)) { ?>
    <?php foreach ($errors as $error) { ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $error; ?>
        </div>
    <?php } ?>
<? } ?>