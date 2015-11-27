<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="imagetoolbar" content="no">
        <title>GENRE SHUFFLE 3</title>
        <meta name="description" content="BMSイベント「ジャンルシャッフル3」のイベントページです。">
        <meta name="keywords" content="BMS">
        <link rel="stylesheet" type="text/css" href="common/css/style.css">
        <link rel="stylesheet" type="text/css" href="js/popup.css">
        <link href='http://fonts.googleapis.com/css?family=Allerta+Stencil' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:regular,bold' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Poiret+One|Comfortaa|Nova+Square' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id="header"> 
            <h1>GENRE SHUFFLE 3</h1>
            <p>ジャンル・シャッフル</p>
        </div><!-- header -->
        <div id="container">
            <div id="main">

                <div id="top">

                    <div id="headlink">
                        <ul>
                            <li><a href="result.html" target="_blank">総評</a></li>
                            <li><a href="rule.html" target="_blank">イベントルール</a></li>
                            <li><a href="https://docs.google.com/spreadsheet/ccc?key=0Au0EUedIt6gEdDVGY0VaRVRpVHh6RnlZcW1UNGJCQUE" target="_blank">ジャンル振り分け表</a></li>
                            <li><a href="registration">作品登録フォーム</a></li>
                            <li><a href="dllist">ダウンロードリスト</a></li>
                    </div>

                    <div id="info">
                        {$info_message}
                    </div><!-- info -->

                </div><!-- top -->

                <div id="poster">
                    <img src="./img/poster.png" width="658" height="598" />
                </div>

                <div id="list">
                    <table>
                        {section name=bms_no loop=$bms_data step=-1}
                            <tr>
                                <th>
                                    <span class="point">{$bms_data[bms_no].point|escape}</span> / <span class="impre">{$bms_data[bms_no].imp|escape}</span>
                                </th>
                                <td>
                                    <p class="genre">【 {$bms_data[bms_no].genre|escape} 】</p>
                                    <p class="title"><a href="detail/view/{$bms_data[bms_no].rowid|escape}/">{$bms_data[bms_no].title|escape}</a></p>
                                    <p class="artist">{$bms_data[bms_no].artist|escape}</p>
                                </td>
                            </tr>
                        {/section}
                    </table>
                </div>
            </div><!-- main -->

            <div id="footer">
                <form id="admin" action="admin.php" method="POST">
                    <input type=password name=pwd size=8>
                    <button type="submit" name="mode" value="login">管理者ログイン</button>
                </form>
                <p><a href="http://colosseo.nekokan.dyndns.info/" />Colosseo @ 2011-2015</a></p>
            </div><!-- footer -->

        </div><!-- container -->
    </body> 
</html>
