<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script src="js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-xs-12" style="margin:25px 0">

            <form action="?register" method="POST">

                <br>
                <input type="hidden" name="event_id" value="<?php echo $_GET['event_id'] ?>">

                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="surname">Surname:</label>
                        <input type="text" class="form-control" id="surname" name="surname" placeholder="Enter surname">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-3">
                        <label for="telephone">Telephone:</label>
                        <input type="text" class="form-control" id="telephone" name="telephone"
                               placeholder="Enter telephone number">
                    </div>
                </div>
                <?php foreach ($fields as $item):
                    if ($item['type'] == 'text'):
                        ?>

                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></label>
                                <input type="text" class="form-control" id="<?php echo $item['slug'] ?>"
                                       name="<?php echo $item['slug'] ?>">
                            </div>

                        </div>
                    <?php endif; ?>
                    <?php if ($item['type'] == 'checkbox'): ?>
                    <br>
                    <br>
                    <div class="checkbox">
                        <?php echo $item['title'] ?>
                        <br>
                        <br>
                        <?php $value_array = explode(', ', $item['values']) ?>

                        <?php foreach ($value_array as $value): ?>

                            <input type="checkbox" name="<?php $item['slug'] ?>"> <?php echo $value ?> </input>
                            <br>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                    <?php if ($item['type'] == 'textbox') : ?>

                    <div class="form-group">
                        <label for="<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></label>
                        <textarea class="form-control" rows="5" id="<?php echo $item['slug']?>" name="<?php $item['slug'] ?>"></textarea>
                    </div>
                <?php endif; ?>
                    <?php if ($item['type'] == 'select') : ?>
                    <div class="form-group">
                        <label for="<?php echo $item['slug'] ?>"><?php echo $item['title'] ?></label><br>
                        <select name="<?php echo $item['slug'] ?>">
                            <?php $value_array = explode(', ', $item['values']) ?>
                            <?php foreach ($value_array as $value) : ?>
                                <option><?php echo $value ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>

                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>
    </div>
</div>

</body>
</html>