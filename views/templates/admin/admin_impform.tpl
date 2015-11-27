<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>GENRE-SHUFFLE3</title>
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
    <h2>インプレ編集フォーム</h2>
    <form action="{$root_url}/admin/editimp/" method="POST">
        <input type="hidden" name="bms_no" value="{$bms_no}">
        <input type="hidden" name="imp_no" value="{$imp_no}">
        <table>
                                <tr><td>Name:</td><td><input type="text" name="name" value="{$impression_data.name|escape}"/></td></tr>
                                <tr><td>URL :</td><td><input type="text" name="site_url" size="40" value="{$impression_data.site_url|escape}"/></td></tr>
                                <tr><td>Mail:</td><td><input type="text" name="email" value="{$impression_data.email|escape}"/></td></tr>
                                <tr><td>Score:</td>
                                    <td>
                                        <input type="radio" name="point" value="3" {if $impression_data.point eq 3}checked{/if}/> 3pts 
                                        <input type="radio" name="point" value="2" {if $impression_data.point eq 2}checked{/if}/> 2pts 
                                        <input type="radio" name="point" value="1" {if $impression_data.point eq 1}checked{/if}/> 1pt 
                                        <input type="radio" name="point" value="0" {if $impression_data.point eq 0}checked{/if}/> 0pt 
                                    </td>
                                </tr>
                                <tr><td>Comment:</td><td><textarea name="comment" rows="4" cols="70" >{$impression_data.comment|escape|nl2br}</textarea></td></tr>
        </table>
        <p class="regbot"><button type="submit" name="mode" value="editimp">編集</button></p>
    </form>
                <form action="{$root_url}/admin/deleteimp/" method="POST">
                    <input type="hidden" name="bms_no" value="{$bms_no}">
                    <input type="hidden" name="imp_no" value="{$imp_no}">
                    <p>このインプレッションを削除する : <button type="submit" name="mode" value="deleteimp">削除</button></p>
                </form>
                    <p><a href="{$root_url}/admin/impmenu/{$bms_no}/">戻る</a></p>
</body>
</html>
