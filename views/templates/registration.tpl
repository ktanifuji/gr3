<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="imagetoolbar" content="no">
        <title>GENRE-SHUFFLE3 ::  作品登録</title>
        <link rel="stylesheet" type="text/css" href="common/css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Allerta+Stencil' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:regular,bold' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body id="sub">

        <div id="header">
            <h1>作品登録</h1>
        </div>

        <div id="container"> 
            <div id="main"> 

                <div id="bms" class="stat"> 
                    <p class="genre">作品登録フォーム</p>
                </div>
                <div id="regist-form">
                    {if $is_able_to_register}
                        <form action="thanks.php" method="POST">
                            <table>
                                <tr>
                                    <th>参加表明時の名前</th>
                                    <td>
                                        <select name="pre_id">
                                            <option value="null"></option>
                                            <!--
                                            <?php
                                            for ($i = 0 ; $i < $entry_count ; $i++)
                                            {
                                            $row = hArray($entry_data[$i]);
                                            echo "<option value={$row['rowid']}>{$row['artist_name']}</option>\n";
                                            }
                                            ?>
                                            -->
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <th>参加表明時の<br>パスワード</th>
                                    <td><input type=password name="pre_pwd" size=8></td>
                                </tr>
                                <tr>
                                    <th>ジャンル</th>
                                    <td><input type=text name="genre" size=40 maxlength=50></td>
                                </tr>
                                <tr>
                                    <th>タイトル</th>
                                    <td><input type=text name="title" size=60 maxlength=100></td>
                                </tr>
                                <tr>
                                    <th>名前</th>
                                    <td>
                                        <input type=text name="artist" size=40>
                                        <p class="attention">※参加表明時の名前が分かる記述にしてください</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>TwitterID<br>（任意）</th>
                                    <td><input type=text name="twitter_id" size=60 value="@"></td>
                                </tr>
                                <tr>
                                    <th>メールアドレス<br>（任意）</th>
                                    <td><input type=text name="email" size=60></td>
                                </tr>
                                <tr>
                                    <th>サイトURL<br>（任意）</th>
                                    <td><input type=text name="url" size=60 value="http://"></td>
                                </tr>
                                <tr>
                                    <th>ダウンロードURL</th>
                                    <td><input type=text name="dlurl" size=60 value="http://"></td>
                                </tr>
                                <tr>
                                    <th>コメント</th>
                                    <td><textarea name="comment" cols=60 rows=8 wrap=soft></textarea></td>
                                </tr>
                                <tr>
                                    <th>試聴音源<br>（任意）</th>
                                    <td>
                                        <input type=text name="listen" size=60 value="http://">
                                        <p class="attention">※MP3のアップロードしてあるURLを直接記入してください</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>試聴動画<br>（任意）</th>
                                    <td>
                                        <select name="movie">
                                            <option value="null"></option>
                                            <option value="1">YouTube</option>
                                            <option value="2">ニコニコ動画</option>
                                        </select>
                                        <p class="attention">※YouTube・ニコニコ動画のどちらかを選択してください</p>
                                        <p>動画ID：<input type=text name="movie_id" size=20></p>
                                        <p class="attention">※YouTubeはURLの「?v=」以降のidを、ニコニコ動画はURLの「smxxxxx(数字)」を記入してください</p>
                                    </td>
                                </tr>
                                <tr>
                                    <th>参加者パスワード</th>
                                    <td>
                                        <input type=password name="pwd" size=8>
                                        <p class="attention">※作品詳細画面から、自分の作品情報を変更する際に必要となります</p>
                                    </td>
                                </tr>
                            </table>
                            <p class="regbot"><button type="submit" name="mode" value="regist">登録</button></p>
                        </form>
                    {else}
                        登録期間ではありません。
                    {/if}
                </div>
            </div>
            <div id="footer"> 
                <p class="back"><a href="index.php">Back</a></p>
            </div>
        </div>
    </body>
</html>
