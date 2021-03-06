<?php /* Smarty version 2.6.28, created on 2015-12-06 23:45:01
         compiled from preindex.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'preindex.tpl', 91, false),array('modifier', 'truncate', 'preindex.tpl', 127, false),)), $this); ?>
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
                        <?php echo $this->_tpl_vars['info_message']; ?>

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
                            <?php unset($this->_sections['entry_no']);
$this->_sections['entry_no']['name'] = 'entry_no';
$this->_sections['entry_no']['loop'] = is_array($_loop=$this->_tpl_vars['entry_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['entry_no']['step'] = ((int)-1) == 0 ? 1 : (int)-1;
$this->_sections['entry_no']['show'] = true;
$this->_sections['entry_no']['max'] = $this->_sections['entry_no']['loop'];
$this->_sections['entry_no']['start'] = $this->_sections['entry_no']['step'] > 0 ? 0 : $this->_sections['entry_no']['loop']-1;
if ($this->_sections['entry_no']['show']) {
    $this->_sections['entry_no']['total'] = min(ceil(($this->_sections['entry_no']['step'] > 0 ? $this->_sections['entry_no']['loop'] - $this->_sections['entry_no']['start'] : $this->_sections['entry_no']['start']+1)/abs($this->_sections['entry_no']['step'])), $this->_sections['entry_no']['max']);
    if ($this->_sections['entry_no']['total'] == 0)
        $this->_sections['entry_no']['show'] = false;
} else
    $this->_sections['entry_no']['total'] = 0;
if ($this->_sections['entry_no']['show']):

            for ($this->_sections['entry_no']['index'] = $this->_sections['entry_no']['start'], $this->_sections['entry_no']['iteration'] = 1;
                 $this->_sections['entry_no']['iteration'] <= $this->_sections['entry_no']['total'];
                 $this->_sections['entry_no']['index'] += $this->_sections['entry_no']['step'], $this->_sections['entry_no']['iteration']++):
$this->_sections['entry_no']['rownum'] = $this->_sections['entry_no']['iteration'];
$this->_sections['entry_no']['index_prev'] = $this->_sections['entry_no']['index'] - $this->_sections['entry_no']['step'];
$this->_sections['entry_no']['index_next'] = $this->_sections['entry_no']['index'] + $this->_sections['entry_no']['step'];
$this->_sections['entry_no']['first']      = ($this->_sections['entry_no']['iteration'] == 1);
$this->_sections['entry_no']['last']       = ($this->_sections['entry_no']['iteration'] == $this->_sections['entry_no']['total']);
?>
                                <span class="word"><a><?php echo ((is_array($_tmp=$this->_tpl_vars['entry_data'][$this->_sections['entry_no']['index']]['artist'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></span>
                            <?php endfor; endif; ?>
                        </p>
                    </div>
                    <div class="box-right-info">
                        <h2>投稿ジャンル一覧</h2>
                        <p>
                            <?php unset($this->_sections['entry_no']);
$this->_sections['entry_no']['name'] = 'entry_no';
$this->_sections['entry_no']['loop'] = is_array($_loop=$this->_tpl_vars['genre_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['entry_no']['step'] = ((int)-1) == 0 ? 1 : (int)-1;
$this->_sections['entry_no']['show'] = true;
$this->_sections['entry_no']['max'] = $this->_sections['entry_no']['loop'];
$this->_sections['entry_no']['start'] = $this->_sections['entry_no']['step'] > 0 ? 0 : $this->_sections['entry_no']['loop']-1;
if ($this->_sections['entry_no']['show']) {
    $this->_sections['entry_no']['total'] = min(ceil(($this->_sections['entry_no']['step'] > 0 ? $this->_sections['entry_no']['loop'] - $this->_sections['entry_no']['start'] : $this->_sections['entry_no']['start']+1)/abs($this->_sections['entry_no']['step'])), $this->_sections['entry_no']['max']);
    if ($this->_sections['entry_no']['total'] == 0)
        $this->_sections['entry_no']['show'] = false;
} else
    $this->_sections['entry_no']['total'] = 0;
if ($this->_sections['entry_no']['show']):

            for ($this->_sections['entry_no']['index'] = $this->_sections['entry_no']['start'], $this->_sections['entry_no']['iteration'] = 1;
                 $this->_sections['entry_no']['iteration'] <= $this->_sections['entry_no']['total'];
                 $this->_sections['entry_no']['index'] += $this->_sections['entry_no']['step'], $this->_sections['entry_no']['iteration']++):
$this->_sections['entry_no']['rownum'] = $this->_sections['entry_no']['iteration'];
$this->_sections['entry_no']['index_prev'] = $this->_sections['entry_no']['index'] - $this->_sections['entry_no']['step'];
$this->_sections['entry_no']['index_next'] = $this->_sections['entry_no']['index'] + $this->_sections['entry_no']['step'];
$this->_sections['entry_no']['first']      = ($this->_sections['entry_no']['iteration'] == 1);
$this->_sections['entry_no']['last']       = ($this->_sections['entry_no']['iteration'] == $this->_sections['entry_no']['total']);
?>
                                <span class="word"><a><?php echo ((is_array($_tmp=$this->_tpl_vars['genre_data'][$this->_sections['entry_no']['index']]['genre'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></span>
                            <?php endfor; endif; ?>
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
        <?php unset($this->_sections['entry_no']);
$this->_sections['entry_no']['name'] = 'entry_no';
$this->_sections['entry_no']['loop'] = is_array($_loop=$this->_tpl_vars['entry_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['entry_no']['step'] = ((int)-1) == 0 ? 1 : (int)-1;
$this->_sections['entry_no']['show'] = true;
$this->_sections['entry_no']['max'] = $this->_sections['entry_no']['loop'];
$this->_sections['entry_no']['start'] = $this->_sections['entry_no']['step'] > 0 ? 0 : $this->_sections['entry_no']['loop']-1;
if ($this->_sections['entry_no']['show']) {
    $this->_sections['entry_no']['total'] = min(ceil(($this->_sections['entry_no']['step'] > 0 ? $this->_sections['entry_no']['loop'] - $this->_sections['entry_no']['start'] : $this->_sections['entry_no']['start']+1)/abs($this->_sections['entry_no']['step'])), $this->_sections['entry_no']['max']);
    if ($this->_sections['entry_no']['total'] == 0)
        $this->_sections['entry_no']['show'] = false;
} else
    $this->_sections['entry_no']['total'] = 0;
if ($this->_sections['entry_no']['show']):

            for ($this->_sections['entry_no']['index'] = $this->_sections['entry_no']['start'], $this->_sections['entry_no']['iteration'] = 1;
                 $this->_sections['entry_no']['iteration'] <= $this->_sections['entry_no']['total'];
                 $this->_sections['entry_no']['index'] += $this->_sections['entry_no']['step'], $this->_sections['entry_no']['iteration']++):
$this->_sections['entry_no']['rownum'] = $this->_sections['entry_no']['iteration'];
$this->_sections['entry_no']['index_prev'] = $this->_sections['entry_no']['index'] - $this->_sections['entry_no']['step'];
$this->_sections['entry_no']['index_next'] = $this->_sections['entry_no']['index'] + $this->_sections['entry_no']['step'];
$this->_sections['entry_no']['first']      = ($this->_sections['entry_no']['iteration'] == 1);
$this->_sections['entry_no']['last']       = ($this->_sections['entry_no']['iteration'] == $this->_sections['entry_no']['total']);
?>
            <div class="tooltip" id="tooltip<?php echo $this->_sections['entry_no']['iteration']-1; ?>
">
                <p>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['entry_data'][$this->_sections['entry_no']['index']]['artist'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    <?php if ($this->_tpl_vars['entry_data'][$this->_sections['entry_no']['index']]['twitter_id'] != ''): ?>
                        <br>
                        Twitter: <a href="http://twitter.com/<?php echo ((is_array($_tmp=$this->_tpl_vars['entry_data'][$this->_sections['entry_no']['index']]['twitter_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">@<?php echo ((is_array($_tmp=$this->_tpl_vars['entry_data'][$this->_sections['entry_no']['index']]['twitter_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a>
                    <?php endif; ?>
                    <?php if ($this->_tpl_vars['entry_data'][$this->_sections['entry_no']['index']]['site_url'] != ''): ?>
                        <br>
                        HP: <a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['entry_data'][$this->_sections['entry_no']['index']]['site_url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['entry_data'][$this->_sections['entry_no']['index']]['site_url'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 20, "...", true) : smarty_modifier_truncate($_tmp, 20, "...", true)); ?>
}</a>
                    <?php endif; ?>
                </p>
            </div>
        <?php endfor; endif; ?>
        <?php unset($this->_sections['genre_no']);
$this->_sections['genre_no']['name'] = 'genre_no';
$this->_sections['genre_no']['loop'] = is_array($_loop=$this->_tpl_vars['genre_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['genre_no']['step'] = ((int)-1) == 0 ? 1 : (int)-1;
$this->_sections['genre_no']['show'] = true;
$this->_sections['genre_no']['max'] = $this->_sections['genre_no']['loop'];
$this->_sections['genre_no']['start'] = $this->_sections['genre_no']['step'] > 0 ? 0 : $this->_sections['genre_no']['loop']-1;
if ($this->_sections['genre_no']['show']) {
    $this->_sections['genre_no']['total'] = min(ceil(($this->_sections['genre_no']['step'] > 0 ? $this->_sections['genre_no']['loop'] - $this->_sections['genre_no']['start'] : $this->_sections['genre_no']['start']+1)/abs($this->_sections['genre_no']['step'])), $this->_sections['genre_no']['max']);
    if ($this->_sections['genre_no']['total'] == 0)
        $this->_sections['genre_no']['show'] = false;
} else
    $this->_sections['genre_no']['total'] = 0;
if ($this->_sections['genre_no']['show']):

            for ($this->_sections['genre_no']['index'] = $this->_sections['genre_no']['start'], $this->_sections['genre_no']['iteration'] = 1;
                 $this->_sections['genre_no']['iteration'] <= $this->_sections['genre_no']['total'];
                 $this->_sections['genre_no']['index'] += $this->_sections['genre_no']['step'], $this->_sections['genre_no']['iteration']++):
$this->_sections['genre_no']['rownum'] = $this->_sections['genre_no']['iteration'];
$this->_sections['genre_no']['index_prev'] = $this->_sections['genre_no']['index'] - $this->_sections['genre_no']['step'];
$this->_sections['genre_no']['index_next'] = $this->_sections['genre_no']['index'] + $this->_sections['genre_no']['step'];
$this->_sections['genre_no']['first']      = ($this->_sections['genre_no']['iteration'] == 1);
$this->_sections['genre_no']['last']       = ($this->_sections['genre_no']['iteration'] == $this->_sections['genre_no']['total']);
?>
            <div class="tooltip" id="tooltip<?php echo $this->_sections['entry_no']['total']+$this->_sections['genre_no']['iteration']-1; ?>
">
                <p>
                    <?php echo ((is_array($_tmp=$this->_tpl_vars['genre_data'][$this->_sections['genre_no']['index']]['genre'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                    <?php if ($this->_tpl_vars['genre_data'][$this->_sections['genre_no']['index']]['name'] != '' || $this->_tpl_vars['genre_data'][$this->_sections['genre_no']['index']]['twitter_id'] != ''): ?>
                        <br>【応募者】
                        <?php if ($this->_tpl_vars['genre_data'][$this->_sections['genre_no']['index']]['name'] != ''): ?>
                            <br>名前： <?php echo ((is_array($_tmp=$this->_tpl_vars['genre_data'][$this->_sections['genre_no']['index']]['name'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>

                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['genre_data'][$this->_sections['genre_no']['index']]['twitter_id'] != ''): ?>
                            <br>Twitter: <a href="http://twitter.com/<?php echo ((is_array($_tmp=$this->_tpl_vars['genre_data'][$this->_sections['genre_no']['index']]['twitter_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
">@<?php echo ((is_array($_tmp=$this->_tpl_vars['genre_data'][$this->_sections['genre_no']['index']]['twitter_id'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </p>
            </div>
        <?php endfor; endif; ?>
        <script type="text/javascript" src="js/jquery-1.9.0.min.js"></script>
        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
        <script type="text/javascript" src="js/top.js"></script>
        <script type="text/javascript" src="js/popup.js"></script>
    </body> 
</html>