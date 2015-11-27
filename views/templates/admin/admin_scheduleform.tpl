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
    <h2>スケジュール変更</h2>
    <p>「yyyy/mm/dd hh:mm:ss」の形式で入力してください</p>
    <form action="{$root_url}/admin/editschedule/" method="POST">
        作品登録開始：<input type="text" name="regist_start" size="40" value="{$regist_schedule.start}"><br>
        作品登録終了：<input type="text" name="regist_end" size="40" value="{$regist_schedule.end}"><br>
        評価開始：<input type="text" name="impression_start" size="40" value="{$impression_schedule.start}"><br>
        評価終了：<input type="text" name="impression_end" size="40" value="{$impression_schedule.end}"><br>
        <button type="submit" name="mode" value="edit_schedule">OK</button>
    </form>
        <p><a href="{$root_url}/admin/mainmenu/">戻る</a></p>
</body>
</html>
