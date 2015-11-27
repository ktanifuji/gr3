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
                        <li><a href="{$root_url}/">TOP</a></li>
                        <li><a href="index.html">What's B.J.Cup?</a></li>
                        <li><a href="index.html">Rule</a></li>
                        <li><a href="{$root_url}/registration">Registration</a></li>
                    </ul>
                </div>
                <div id="list">
                    <h3>Another B.J.Cup Stage #01 :: Menu</h3>
                    <h2>Registration</h2>
                    <ul>
                        <li>作品情報修正フォーム（*印は入力必須）</li>
                    </ul>
                    <form action="{$root_url}/revise/revise/" method="POST" class="event_form">
                        <input type="hidden" name="bms_no" value="{$bms_no}"/>
                        <table class="details" width="95%" align="center">
                            <tr>
                                <th width="25%">*Genre</th>
                                <td class="details"><input type="text" name="genre" size="40" maxlength="50" value="{$bms_data.genre|escape}"/></td>
                            </tr>
                            <tr>
                                <th>*Title</th>
                                <td class="details"><input type="text" name="title" size="60" maxlength="100" value="{$bms_data.title|escape}"/></td>
                            </tr>
                            <tr>
                                <th>*Artist</th>
                                <td class="details"><input type="text" name="artist" size="40" value="{$bms_data.artist|escape}"/></td>
                            </tr>
                            <tr>
                                <th>Mail</th>
                                <td class="details"><input type="text" name="email" size="60" value="{$bms_data.email|escape}"/></td>
                            </tr>
                            <tr>
                                <th>Site</th>
                                <td class="details"><input type="text" name="site_url" size="60" value="{if $bms_data.site_url ne ''}{$bms_data.site_url|escape}{else}http://{/if}"/></td>
                            </tr>
                            <tr>
                                <th>*BGA</th>
                                <td class="details">
                                    <select name="bga">
                                        <option value="{$bms_data.bga|escape}">{$bms_data.bga|escape}</option>
                                        <option value="None">None</option>
                                        <option value="Include">Include</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>*Level</th>
                                <td class="details">
                                    ★x<select name="min_level">
                                        <option value="{$bms_data.min_level|escape}">{$bms_data.min_level|escape}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="more">more</option>
                                    </select>
                                    ～
                                    ★x<select name="max_level">
                                        <option value="{$bms_data.max_level|escape}">{$bms_data.max_level|escape}</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">6</option>
                                        <option value="7">7</option>
                                        <option value="8">8</option>
                                        <option value="9">9</option>
                                        <option value="10">10</option>
                                        <option value="11">11</option>
                                        <option value="12">12</option>
                                        <option value="more">more</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>*BPM</th>
                                <td class="details"><input type="text" name="bpm" size="5" value="{$bms_data.bpm|escape}"/></td>
                            </tr>
                            <tr>
                                <th>*Comment</th>
                                <td class="details"><textarea name="comment" cols="60" rows="8" wrap="soft">{$bms_data.comment|escape}</textarea></td>
                            </tr>
                            <tr>
                                <th>*URL</th>
                                <td class="details"><textarea name="dl_url" cols="60" rows="3" wrap="soft">{$bms_data.dl_url|escape}</textarea></td>
                            </tr>
                            <tr>
                                <th>*Size</th>
                                <td class="details"><input type="text" name="size" size="10" value="{$bms_data.size|escape}"/> KB</td>
                            </tr>
                            <tr>
                                <th>Sample MP3</th>
                                <td class="details"><input type="text" name="listen_url" size="60" value="{if $bms_data.listen_url ne ''}{$bms_data.listen_url|escape}{else}http://{/if}"/></td>
                            </tr>
                            <tr>
                                <th>*Password</th>
                                <td class="details"><input type="password" name="password" size="8"/>（8文字まで）</td>
                            </tr>
                            <tr>
                                <th></th>
                                <td class="details"><input type="submit" name="mode" value="登録情報を修正する" class="submit_button"/></td>
                            </tr>
                        </table>
                    </form>
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
