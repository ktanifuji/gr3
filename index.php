<?php

// システムのルートディレクトリパス
define('ROOT_PATH', realpath(dirname(__FILE__)));
// ライブラリのディレクトリパス
define('LIB_PATH', realpath(dirname(__FILE__) . '/lib'));

define('SMARTY_PATH', realpath(dirname(__FILE__) . '/lib/mvc/Smarty/libs'));
require_once(SMARTY_PATH . '/Smarty.class.php');

define('ROOT_URL',  "/c04_shuffle3");

// ライブラリとモデルのディレクトリをinclude_pathに追加
$includes = array(LIB_PATH . '/mvc', ROOT_PATH . '/models');
$incPath = implode(PATH_SEPARATOR, $includes);
set_include_path(get_include_path() . PATH_SEPARATOR . $incPath);

// クラスのオートロード
function __autoload($className)
{
    require_once $className . ".php";
}

/**
 * blowfish 与えられた文字列とコストから Blowfish ハッシュを返す
 * 
 * @param $raw 元の文字列（平文パスワード）
 * @param $cost コスト（4以上31以下の整数）
 * @return string 引数で指定した文字列の Blowfish ハッシュ
 */
function blowfish($raw, $cost = 4) {
    // Blowfishのソルトに使用できる文字種
    $chars = array_merge(range('a', 'z'), range('A', 'Z'), array('.', '/'));

    // ソルトを生成（上記文字種からなるランダムな22文字）
    $salt = '';
    for ($i = 0; $i < 22; $i++) {
        $salt .= $chars[mt_rand(0, count($chars) - 1)];
    }

    // コストの前処理
    $costInt = intval($cost);
    if ($costInt < 4) {
        $costInt = 4;
    } elseif ($costInt > 31) {
        $costInt = 31;
    }

    // 指定されたコストで Blowfish ハッシュを得る
    return crypt($raw, '$2y$' . sprintf('%02d', $costInt) . '$' . $salt);
}

// リクエスト処理
$dispatcher = new Dispatcher();
$dispatcher->setSystemRoot(ROOT_PATH);
$dispatcher->dispatch();
