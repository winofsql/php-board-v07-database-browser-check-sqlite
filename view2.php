<!DOCTYPE html>
<html lang="ja">
<?php // MARK:HEAD ?>
<head>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta charset="utf-8">
    <title>掲示板</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="client.css?_=<?= time() ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<?php // MARK:SCRIPT ?>
<script>
$(function(){

    <?= $clear ?>

});
</script>

</head>

<?php // MARK:BODY ?>
<body>
<div id="data_head" class="alert alert-primary">投稿一覧 (<?= $kensu ?>件)</div>
<div id="data_body">
    <span style='color:red'>
        <?php
            foreach( $error as $err ) {
                print "{$err}<br>";
            }
        ?>
    </span>
    <div id="data_entry">
        <?= $log_text ?>
    </div>
</div>
</body>
</html>
