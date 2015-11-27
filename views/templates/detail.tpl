<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Style-Type" content="text/css" />
        <meta http-equiv="Content-Script-Type" content="text/javascript" />
        <meta http-equiv="imagetoolbar" content="no" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="{$root_url}/css/common.css" type="text/css" />
        <script type="text/javascript" src="{$root_url}/js/jquery.js"></script>
        <script type="text/javascript" src="{$root_url}/js/common.js"></script>
        <title>Another B.J.Cup Stage #01:Alternative</title>
    </head>
    <body>
        <div id="parent">
            <div id="top">
                <div id="menu">
                    <ul>
                        <li><a href="index.html">TOP</a></li>
                        <li><a href="index.html">What's B.J.Cup?</a></li>
                        <li><a href="index.html">Latest Event</a></li>
                        <li><a href="index.html">Vote</a></li>
                        <li><a href="index.html">Contact</a></li>
                    </ul>
                </div><!-- /#menu -->
                <div id="headImage">
                    <img src="{$root_url}/images/banner_1st.png" alt="Another B.J.Cup #01:Alternative" title="Illustrations:石王マサト"  />
                </div><!-- /#headImage -->
                <div id="subscribe">
                    <p>
                        {literal}
                            <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://starkey.ivory.ne.jp/bjcup/" data-hashtags="AnotherBJC">Tweet</a>
                            <script>!function(d, s, id){var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location)?'http':'https'; if (!d.getElementById(id)){js = d.createElement(s); js.id = id; js.src = p + '://platform.twitter.com/widgets.js'; fjs.parentNode.insertBefore(js, fjs); }}(document, 'script', 'twitter-wjs');</script>
                        {/literal}
                    </p>
                    {if $is_able_to_register}
                        <h2>登録期間中です。</h2>
                    {else}
                        <h2>登録期間は終了しました。</h2>
                    {/if}
                    <ul>
                        <li><a href="index.html">TOP</a></li>
                        <li><a href="{$root_url}/detail/view/{$bms_no-1|escape}/">>></a></li>
                        <li><a href="{$root_url}/detail/view/{$bms_no+1|escape}/"><<</a></li>
                        <li><a href="{$root_url}/">一覧に戻る</a></li>
                    </ul>
                </div>      
                <div id="list">

                    <h3>Another B.J.Cup Stage #01 :: Menu</h3>
                    <h2>Detail</h2>
                    <ul>
                        <li>指定された楽曲の登録内容，及び関連するインプレッションを表示しております。</li>
                    </ul>
                    <table class="details" width="95%" align="center">
                        <tr>
                            <th width="25%"> Genre </th>
                            <td class="details">{$bms_data.genre|escape}</td>
                        </tr>
                        <tr>
                            <th> Title </th>
                            <td class="details"> {$bms_data.title|escape} </td>
                        </tr>
                        <tr>
                            <th> Artist </th>
                            <td class="details">
                                {if $bms_data.site_url ne ''}
                                    <a href="{$bms_data.site_url|escape}">{$bms_data.artist|escape}</a>
                                {else}
                                    {$bms_data.artist|escape} 
                                {/if}
                                {if $bms_data.email ne ''}
                                    <a href="mailto:{$bms_data.email|escape}">@</a>
                                {/if}
                            </td></tr>
                        <tr>
                            <th> Info </th>
                            <td class="details">BGA: {$bms_data.bga|escape} / Level: ★x{$bms_data.min_level|escape}～★x{$bms_data.max_level|escape} / BPM: {$bms_data.bpm|escape}</td>
                        </tr>
                        <tr>
                            <th> Comment </th>
                            <td class="details">{$bms_data.comment|escape|nl2br}</td>
                        </tr>
                        <tr>
                            <th> Impression / Score </th>
                            <td class="details"> 
                                {$bms_data.imp|escape} / {$bms_data.point|escape}
                            </td>
                        </tr>
                        <tr>
                            <th> URL </th>
                            <td class="details"> 
                                {$bms_data.dl_url|escape|nl2br|auto_link} ({$bms_data.size|escape}KB)
                            </td>
                        </tr>
                        {if $bms_data.listen_url ne ''}
                            <tr>
                                <th> Sample MP3 </th>
                                <td class="details"> 
                                    <object type="application/x-shockwave-flash" width="480" height="20" data="{$root_url}/singlemp3player.swf?file={$bms_data.listen_url|escape}&backColor=FFFFFF&frontColor=333333&showDownload=false">
                                        <param name="movie" value="{$root_url}/singlemp3player.swf?file={$bms_data.listen_url|escape}&backColor=FFFFFF&frontColor=333333" />
                                        <param name="wmode" value="transparent" />
                                    </object></td>
                            </tr>
                        {/if}
                    </table>
                    <ul>
                        {if $is_able_to_post_impression}
                            <li>インプレ投稿期間中です。</li>
                            {else}
                            <li>インプレ投稿期間は終了致しました。</li>
                            {/if}
                    </ul>
                    {if $is_able_to_post_impression}
                        <form action="{$root_url}/detail/post/" method="post" class="event_form">
                            <input type="hidden" name="bms_no" value="{$bms_no}"/>
                            <table width="50%" align="center">
                                <tr><td>Name:</td><td><input type="text" name="name" /></td></tr>
                                <tr><td>URL :</td><td><input type="text" name="site_url" size="40"/></td></tr>
                                <tr><td>Mail:</td><td><input type="text" name="email" /></td></tr>
                                <tr><td>Score:</td>
                                    <td>
                                        <input type="radio" name="point" value="3" /> 3pts 
                                        <input type="radio" name="point" value="2" /> 2pts 
                                        <input type="radio" name="point" value="1" /> 1pt 
                                        <input type="radio" name="point" value="0" /> 0pt 
                                    </td>
                                </tr>
                                <tr><td>Comment:</td><td><textarea name="comment" rows="4" cols="70" >ヤバい！！</textarea></td></tr>
                                <tr><td></td><td><input type="submit" name="mode" value="インプレを投稿する" class="submit_button"></td></tr>
                            </table>
                        </form>
                    {/if}
                    <p class="posted">{$bms_data.post_time|escape} <span style="font-size:x-small;">(Id：{$bms_data.user_id|escape})</span>  <a href="{$root_url}/revise/form/{$bms_no}/">rev</a></p>
                    {section name=imp_no loop=$impression_data step=-1}
                        <h3>Impression: {$impression_data[imp_no].point|escape} pt(s)</h3>
                        <p>{$impression_data[imp_no].comment|escape|nl2br}</p>
                        <p class="posted">
                            {if $impression_data[imp_no].site_url ne ''}
                                投稿者  <a href="{$impression_data[imp_no].site_url|escape}">{$impression_data[imp_no].name|escape}</a>
                            {else}
                                投稿者  {$impression_data[imp_no].name|escape}
                            {/if}

                            {if $impression_data[imp_no].email ne ''}
                                <a href="mailto:{$impression_data[imp_no].email|escape}">@</a>
                            {/if}
                            <span style="font-size:x-small;">[{$impression_data[imp_no].post_time|escape}] Id：{$impression_data[imp_no].user_id|escape}</span>
                        </p>
                    {/section}         
                </div>
                <div id="pageTop">
                    <a href="#top">ページのトップへ戻る</a>
                </div><!-- /#pageTop -->
                <div id="footer">
                    <div class="copyright">Copyright &copy; 2015 Starkey Project All Rights Reserved.</div>
                </div><!-- /#footer -->
            </div><!-- /#top -->
        </div><!-- /#parent -->
    </body>
</html>
