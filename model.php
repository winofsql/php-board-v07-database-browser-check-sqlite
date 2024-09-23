<?php
// *************************************
// MARK:check_post
// 入力チェック
// *************************************
function check_post() {

    // デバッグ用
    file_put_contents("check_post.log", print_r($_POST,true) ,FILE_APPEND );

    global $error;

    $GLOBALS["name"]	= trim( $_POST['name'] );
    $GLOBALS["subject"]	= trim( $_POST['subject'] );
    $GLOBALS["text"]	= trim( $_POST['text'] );

    // *************************************
    // エラー処理
    // *************************************
    if ( $GLOBALS["subject"] == '' ){
        $error['subject'] = 'タイトル入力してください';
    }
    if ( $GLOBALS["name"] == '' ){
        $error['name'] = 'お名前を入力してください';
    }
    if ( $GLOBALS["text"] == '' ){
        $error['text'] = '本文を入力してください';
    }

    file_put_contents("check_post.log", print_r($error,true), FILE_APPEND );

}

// **************************************
// MARK:write_data
// データの書き込み処理
// **************************************
function write_data() {

    global $error;
    global $clear;

    // DB 接続
    $dbh = connectDb();
    if ( $dbh == null ) {
        return false;
    }

    $sql = "insert into board
            (`from`, body, cdate, subject)
            values
            (:from, :body, datetime('now'), :subject)";

    file_put_contents( "debug.log", $sql . "\n", FILE_APPEND );

    try {
        // SQL 文の準備
        $stmt = $dbh->prepare($sql);

        $stmt->bindValue( ':subject', $GLOBALS["subject"], PDO::PARAM_STR );
        $stmt->bindValue( ':from', $GLOBALS["name"], PDO::PARAM_STR );
        $stmt->bindValue( ':body', $GLOBALS["text"], PDO::PARAM_STR );

        // 完成した SQL の実行
        $stmt->execute();

    }
    catch ( PDOException $e ) {
        $error['db'] = $e->getMessage();
        return false;
    }

    $clear = <<<SCRIPT

    parent.$("input[name='subject']").val("");
    parent.$("input[name='name']").val("");
    parent.$("textarea").val("");

SCRIPT;

}

// **************************************
// MARK:read_data
// データの表示処理
// **************************************
function read_data() {

    global $logfile,$kensu;

    // 埋め込み用データを global 宣言
    global $log_text;

    // DB 接続
    $dbh = connectDb();
    if ( $dbh == null ) {
        return false;
    }

    try {
        $stmt = $dbh->prepare("select * from board order by row_no desc");
        $stmt->execute();
    }
    catch ( PDOException $e ) {
        $error["db"] = $e->getMessage();
        return;
    }

    $log_text = "";
    $kensu = 0;
    file_put_contents("read_data.log", print_r($stmt,true));
    while( $entry = $stmt->fetch() ) {

        file_put_contents("read_data.log", print_r($entry,true), FILE_APPEND);

        foreach( $entry as $key => $value ) {

            // HTML 要素を無効にする
            $entry[$key] = htmlspecialchars( $value );

        }

        // **************************************
        // 本文の改行は br 要素で表現します
        // **************************************
        $entry['body'] = str_replace("\n", "<br>\n", $entry['body'] );

        // **************************************
        // 記事の境界を hr 要素で表現します
        // **************************************
        $entry['body'] .= "<hr>\n";

        // **************************************
        // 行毎に表示 HTML を作成
        // **************************************
        $log_text .= "<div class='title'>【{$entry['subject']}】( {$entry['from']} : {$entry['cdate']} ) </div>" . $entry['body'];

        $kensu++;

    }


}

// *************************************
// MARK:connectDb
// データベース接続
// *************************************
function connectDb(){

    global $error;

    $result = null;

    try {
        // 合同用
        // $result = new PDO( 'sqlite:../bbs.sqlite3' );
        // 単独用
        $result = new PDO( 'sqlite:./bbs.sqlite3' );
    }
    catch ( PDOException $e ) {
        $error["db"] .= $e->getMessage();
        return $result;
    }
    // 接続以降で try ～ catch を有効にする設定
    $result->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $result;

}

// **************************
// MARK:debug_print
// デバッグ表示
// **************************
function debug_print() {

    print "<pre class=\"m-5\">";
    print_r( $_GET );
    print_r( $_POST );
    print_r( $_SESSION );
    print "</pre>";

}

?>
