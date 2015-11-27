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
    <h2>管理メニュー</h2>
    <p><a href="{$root_url}/admin/infoform/">インフォメーション欄を編集する</a> / <a href="{$root_url}/admin/scheduleform/">スケジュールを変更する</a></p>
    
    <table border="1">
        <tr><th>No.</th><th>タイトル / 作者名</th><th>作品情報編集・削除フォームへ</th><th>インプレ編集メニューへ</th></tr>
        {section name=bms_no loop=$bms_data step=-1}
        <tr>
            <td>{$bms_data[bms_no].rowid|escape}.</td>
            <td>{$bms_data[bms_no].title|escape} / {$bms_data[bms_no].artist|escape}</td>
            <td><a href='{$root_url}/admin/bmseditform/{$bms_data[bms_no].rowid|escape}/'>GO</a></td>
            <td><a href='{$root_url}/admin/impmenu/{$bms_data[bms_no].rowid|escape}/'>GO</a></td>
        </tr>
        {/section}
    </table>
    
    <form action="{$root_url}/admin/changemasterpass/" method="POST">
        <p>管理パスワードを変更 : <input type="password" name="password" size="8"><button type="submit" name="mode" value="changemasterpass">変更</button></p>
    </form>
</body>
</html>
