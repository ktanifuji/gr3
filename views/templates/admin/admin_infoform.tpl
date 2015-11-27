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
    <h2>インフォメーション編集</h2>
    <form action="{$root_url}/admin/editinfo/" method="POST">
        <textarea name="info" rows="20" cols="100">{$info_message}</textarea><br>
        <button type="submit" name="mode" value="edit_info">OK</button>
    </form>
<br>
<a href="{$root_url}/admin/mainmenu/">戻る</a><br>

</body>
</html>
