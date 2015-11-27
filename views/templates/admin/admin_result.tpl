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
    <table border='1'>
        <tr><th>順位</th><th>タイトル</th><th>作者名</th><th>スコア</th></tr>
        {section name=bms_no loop=$bms_data}
        <tr>
            <td>{$smarty.section.bms_no.index+1}</td>
            <td><a href='{$root_url}/detail/view/{$bms_data[bms_no].rowid|escape}/'>{$bms_data[bms_no].title|escape}</a></td>
            <td>{$bms_data[bms_no].artist|escape}</td>
            <td>{$bms_data[bms_no].point|escape}</td>
        </tr>
        {/section}
    </table>
</body>
</html>
