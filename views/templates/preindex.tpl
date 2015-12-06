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
        <link href='http://fonts.googleapis.com/css?family=Poiret+One|Comfortaa|Nova+Square' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>

    <body>
        <div id="header"> 
            <h1><img src="./img/gs3logo.svg" width="658" alt="GENRE-SHUFFLE 3" /></h1>
            <p>ジャンル・シャッフル３</p>
        </div> <!-- header -->

        <div id="container">

            <div id="main">
                <div id="top">
                    <div id="headlink">
                        <ul>
                            <li><a href="rule.html" target="_blank">イベントルール</a></li>
                            <li class="no-open">ジャンル振り分け表</li>
                            <li class="no-open">作品登録フォーム</li>
                    </div>
                    <div id="info">
                        {$info_message}
                    </div><!-- info -->
                </div><!-- top -->
                
                <div id="youtube">
                  <iframe class="auto" width="720" height="405" src="https://www.youtube.com/embed/PhOCdW9_JIo?rel=0&amp;autoplay=1&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                  <iframe class="noauto" width="720" height="405" src="https://www.youtube.com/embed/PhOCdW9_JIo?rel=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                </div>

                <div id="poster">
                    <img src="./img/poster.png" width="658" />
                </div>

                <div class="box">
                    <div class="box-left">
                        <h2>作品参加表明フォーム</h2>
                        <form action="entry/entry/" method="POST">
                            <div class="form-txt">
                                <table>
                                    <tr><th>名前 <span>*</span></th><td><input type=text name="artist"></td></tr>
                                    <tr><th>Mail</th><td><input type=text name="email"></td></tr>
                                    <tr><th>TwitterID</th><td><input type=text name="twitter_id" value="@"></td></tr>
                                    <tr><th>サイトURL</th><td><input type=text name="site_url" value="http://"></td></tr>
                                    <tr><th>作品登録パスワード <span>*</span></th><td><input type=password name="password" size=8></td></tr>
                                </table>
                                <p class="attension">※<span>*</span>印は必須項目です<br />※パスワードは作品登録に必須のため必ず手元に控えてください<br />※パスワードは4桁の数字を入力してください</p>
                            </div>
                            <div class="send-button">
                                <input type="submit" name="mode" value="参加表明">
                            </div>
                        </form>
                    </div>
                    <div class="box-right">
                        <h2>ジャンル応募フォーム</h2>
                        <form action="genre/entry" method="POST">
                            <div class="form-txt">
                                <table>
                                    <tr><th>名前</th><td><input type=text name="name" size=30></td></tr>
                                    <tr><th>TwitterID</th><td><input type=text name="twitter_id" size=30 value="@"></td></tr>
                                    <tr><th>ジャンル名 <span>*</span></th><td><input type=text name="genre" size=30></td></tr>
                                </table>
                                <p class="attension">※<span>*</span>印は必須項目です<br />※名前とTwitterIDは両方入力する必要はありません<br />※実在のジャンル名で応募してください<br />※ジャンルの投稿は1人1つまでとなります</p>
                            </div>
                            <div class="send-button">
                                <input type="submit" name="mode" value="投稿">
                            </div>
                        </form>
                    </div>
                </div><!-- regist -->

                <div class="box">
                    <div class="box-left-info">
                        <h2>参加者一覧</h2>
                        <p>
                            {section name=entry_no loop=$entry_data step=-1}
                                <span class="word"><a>{$entry_data[entry_no].artist|escape}</a></span>
                            {/section}
                        </p>
                    </div>
                    <div class="box-right-info">
                        <h2>投稿ジャンル一覧</h2>
                        <p>
                            {section name=entry_no loop=$genre_data step=-1}
                                <span class="word"><a>{$genre_data[entry_no].genre|escape}</a></span>
                            {/section}
                        </p>
                    </div>
                </div><!-- info -->

            </div>

            <div id="footer">
                <!--
                <form id="admin" action="admin" method="POST">
                    <input type=password name=pwd size=8>
                    <button type="submit" name="mode" value="login">管理者ログイン</button>
                </form>
                -->
                <p><a href="http://colosseo.nekokan.dyndns.info/" />Colosseo @ 2011-2015</a></p>
            </div><!-- footer -->
        </div>
        {section name=entry_no loop=$entry_data step=-1}
            <div class="tooltip" id="tooltip{$smarty.section.entry_no.iteration-1}">
                <p>
                    {$entry_data[entry_no].artist|escape}
                    {if $entry_data[entry_no].twitter_id ne ''}
                        <br>
                        Twitter: <a href="http://twitter.com/{$entry_data[entry_no].twitter_id|escape}">@{$entry_data[entry_no].twitter_id|escape}</a>
                    {/if}
                    {if $entry_data[entry_no].site_url ne ''}
                        <br>
                        HP: <a href="{$entry_data[entry_no].site_url|escape}">{$entry_data[entry_no].site_url|escape|truncate:20:"...":true}}</a>
                    {/if}
                </p>
            </div>
        {/section}
        {section name=genre_no loop=$genre_data step=-1}
            <div class="tooltip" id="tooltip{$smarty.section.entry_no.total+$smarty.section.genre_no.iteration-1}">
                <p>
                    {$genre_data[genre_no].genre|escape}
                    {if $genre_data[genre_no].name ne '' || $genre_data[genre_no].twitter_id ne ''}
                        <br>【応募者】
                        {if $genre_data[genre_no].name ne ''}
                            <br>名前： {$genre_data[genre_no].name|escape}
                        {/if}
                        {if $genre_data[genre_no].twitter_id ne ''}
                            <br>Twitter: <a href="http://twitter.com/{$genre_data[genre_no].twitter_id|escape}">@{$genre_data[genre_no].twitter_id|escape}</a>
                        {/if}
                    {/if}
                </p>
            </div>
        {/section}
        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script type="text/javascript" src="js/top.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
    </body> 
</html>
