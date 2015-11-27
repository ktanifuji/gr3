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
    <h2>インプレッション編集メニュー</h2>
    <table border='1'>
        <tr><th>No.</th><th>名前</th><th>ポイント</th><th>コメント</th><th>編集フォームへ</th></tr>
        {section name=imp_no loop=$impression_data step=-1}
            <tr>
                <td>{$impression_data[imp_no].rowid}</td>
                <td>{$impression_data[imp_no].name|escape}</td>
                <td>{$impression_data[imp_no].point|escape}</td>
                <td>{$impression_data[imp_no].comment|escape|nl2br}</td>
                <td><a href="{$root_url}/admin/impform/{$bms_no}/{$impression_data[imp_no].rowid}/">GO</a></td>
            </tr>
        {/section}
    </table>
    <p><a href="{$root_url}/admin/mainmenu/">戻る</a></p>
</body>
</html>
