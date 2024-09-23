<!DOCTYPE html>
<html lang="ja">
<?php // MARK:HEAD ?>
<head>
    <meta content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport">
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <title>掲示板 v07 SQLite</title>

<?php require_once("iframe-css.php") ?>
    <link rel="stylesheet" href="client.css?_=<?= time() ?>">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script>


<?php // MARK:SCRIPT ?>
<script>
jQuery.isMobile = (/android|webos|iphone|ipad|ipod|blackberry|iemobile|opera mini/i.test(navigator.userAgent.toLowerCase()));
toastr.options={"closeButton":false,"debug":false,"newestOnTop":false,"progressBar":false,"positionClass":"toast-bottom-center","preventDuplicates":false,"onclick":null,"showDuration":"300","hideDuration":"1000","timeOut":"3000","extendedTimeOut":"1000","showEasing":"swing","hideEasing":"linear","showMethod":"fadeIn","hideMethod":"fadeOut"};
if ( !$.isMobile ) {
    toastr.options.positionClass = "toast-top-center";
}

$( function(){

    // フォーム送信イベント
    $("form").on("submit", function(){

        var name = $("#name").val();
        name = name.trim();
        if ( name == "" ) {
            // 本来の送信処理はキャンセルする
            event.preventDefault();
            toastr.error("お名前を入力してください");
        }

        var text = $("#text").val();
        text = text.trim();
        if ( text == "" ) {
            // 本来の送信処理はキャンセルする
            event.preventDefault();
            toastr.error("本文を入力してください");
        }

    });

});

</script>
</head>

<?php // MARK:BODY ?>
<body>
<div id="bbs">
    <h3 class="alert alert-primary">
        <a href="control.php" style="color:black;">掲示板 ( SQLite )</a>
        <a href=".." style="float:right;text-decoration:none;">📂</a>
    </h3>
    <div id="content"
        >
        <form action=""
            target="myframe"
            method="POST">
            <div>
                <span class="title_entry">
                    タイトル
                </span>
                <input
                    type="text"
                    name="subject"
                    pattern=".*\S+.*"
                    required
                    >
            </div>
            <div>
                <span class="title_entry">
                    名前
                </span>
                <input
                    type="text"
                    name="name"
                    id="name"
                    pattern="[ぁ-んァ-ン一-龥 　]+"
                    required
                    >
            </div>
            <div>
                <textarea name="text" id="text"></textarea>
            </div>
            <div>
                <input type="submit" name="send" value="送信">
            </div>
            <input type="hidden" name="datetime" id="datetime">
        </form>
    </div>
</div>

<?php // MARK:IFRAME ?>
<iframe id="extend" src="control.php?page=init" name="myframe"></iframe>

</body>
</html>
