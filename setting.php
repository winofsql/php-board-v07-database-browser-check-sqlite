<?php
// ******************************
// PHP 8用
// isset を使用せずに、変数に対して
// 直接 "" を使用して空であると
// 判断可能にする
// ******************************
$pv = explode(".", phpversion());
if ($pv[0] + 0 >= 8) {
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED & ~E_WARNING);
} else {
    error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED);
}

// ******************************
// キャッシュ
// ******************************
session_cache_limiter('nocache');
session_start();

// ******************************
// 日本語用
// ******************************
mb_language('Japanese');
mb_internal_encoding('UTF-8');

// ******************************
// グローバル変数
// ******************************
$log_text = "";
$kensu = "";
$error = [];
$clear = "";
// iframe-css.php で 使用。入力部分の高さの定義
$view_head_height = "330";
