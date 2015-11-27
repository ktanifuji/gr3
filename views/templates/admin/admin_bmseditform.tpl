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
        <h2>BMS情報編集フォーム</h2>
        <form action="{$root_url}/admin/editbms/" method="POST">
            <input type="hidden" name="bms_no" value="{$bms_no}">
            <table>
                <tr>
                    <th>*Genre</th>
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
            </table>
            <p class="regbot"><button type="submit" name="mode" value="editbms">編集</button></p>
        </form>
        <form action="{$root_url}/admin/deletebms/" method="POST">
            <input type="hidden" name="bms_no" value="{$bms_no}">
            <p>この登録を削除する : <button type="submit" name="mode" value="deletebms">削除</button></p>
        </form>
        <form action="{$root_url}/admin/issuepwd/" method="POST">
            <input type="hidden" name="bms_no" value="{$bms_no}">
            <p>パスワードを再発行 : <input type="password" name="password" size="8"><button type="submit" name="mode" value="issuepwd">再発行</button></p>
        </form>
        <p><a href="{$root_url}/admin/mainmenu/">戻る</a></p>
    </body>
</html>
