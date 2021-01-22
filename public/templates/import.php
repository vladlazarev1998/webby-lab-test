<?php echo $header; ?>
    <div class="container mt-3">
        <div class="row">
            <h1>Импорт</h1>
            <?php if (!empty($errors)) { ?>
                <?php foreach ($errors as $error) { ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php } ?>
            <? } ?>
            <?php if (!empty($success)) { ?>
                <?php foreach ($success as $succes) { ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $succes; ?>
                    </div>
                <?php } ?>
            <? } ?>
            <form action="/import" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleFormControlFile1">Выберите файл</label>
                </div>
                <div class="form-group mt-3">
                    <input required  type="file" class="form-control-file" id="file" name="import">
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-primary">Импорт</button>
                </div>
            </form>
        </div>
    </div>
<?php echo $footer; ?>