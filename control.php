<?php
// *************************************
// MARK:基本設定
// *************************************
require_once("setting.php");

// HTML としてブラウザに送る時の処理
header( "Content-Type: text/html; charset=utf-8" );

// 処理関数の読み込み
require_once("model.php");

// **************************************
// $_POST['send'] != "" は送信ボタンが
// クリックされた事を示します
// さらに、テキストエリアに何か入力され
// た場合に処理を行います
// **************************************
$_POST['text'] = preg_replace( "/^[　\s]+/u", "", $_POST['text'] );
$_POST['text'] = preg_replace( "/[　\s]+$/u", "", $_POST['text'] );
if ( $_POST['send'] != "" ) {

    // POST 内容をチェックして
    check_post();
    if ( count( $error ) == 0 ) {
        // エラーが無ければ更新処理
        write_data();
    }

}

// *************************************
// 画面
// 初期画面 => 1) => 2)
// 送信 => 3)
// -------------------------------------
// control.php を 1) と 2) を使用して
// 初期画面を表示
// FORM による送信処理は myframe 内で表示
// *************************************
// 1) 初期画面( アドレスバーより )
if ( $_SERVER["REQUEST_METHOD"] == "GET" && $_GET["page"] != "init" ) {
    require_once("view.php");
}
// 2) 初期画面表示時の、中の IFRAME 部分の表示
if ( $_SERVER["REQUEST_METHOD"] == "GET" && $_GET["page"] == "init" ) {
    read_data( );
    require_once("view2.php");
}
// 3) 初期画面の FORM の TARGET( myframe )
if ( $_SERVER["REQUEST_METHOD"] == "POST" ) {
    read_data( );
    require_once("view2.php");
}


//debug_print();
?>
