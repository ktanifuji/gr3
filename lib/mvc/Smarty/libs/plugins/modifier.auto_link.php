<?php
/**
 * URL自動リンクプラグイン<br>
 * 指定された文字列にURLが含まれる場合、その個所をaタグで囲む。<br>
 *
 * @param string 文字列
 * @return string URLをaタグで囲んだ文字列
 * @access public
 */
function smarty_modifier_auto_link($string) {
    // nullまたは空文字の場合、そのまま返却する。
    if (is_null($string)) {
        return $string;
    }
 
    // URL形式のチェック用正規表現
    $regString = '/(https?|ftp)(:\/\/[-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)/';
 
    return preg_replace($regString, "<a href=\"\\0\" target=\"_blank\">\\0</a>", $string);
}
?>
