<!DOCTYPE html>
<html lang="ja">
<head>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta charset="utf-8">
    <title>掲示板</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="client.css?_=<?= time() ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(function(){

    <?= $clear ?>

});
</script>

</head>

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
