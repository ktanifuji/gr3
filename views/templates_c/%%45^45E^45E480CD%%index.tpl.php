<?php /* Smarty version 2.6.28, created on 2015-11-22 11:48:15
         compiled from index.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'index.tpl', 55, false),)), $this); ?>
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
                        <?php echo $this->_tpl_vars['info_message']; ?>

                    </div><!-- info -->

                </div><!-- top -->

                <div id="poster">
                    <img src="./img/poster.png" width="658" height="598" />
                </div>

                <div id="list">
                    <table>
                        <?php unset($this->_sections['bms_no']);
$this->_sections['bms_no']['name'] = 'bms_no';
$this->_sections['bms_no']['loop'] = is_array($_loop=$this->_tpl_vars['bms_data']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['bms_no']['step'] = ((int)-1) == 0 ? 1 : (int)-1;
$this->_sections['bms_no']['show'] = true;
$this->_sections['bms_no']['max'] = $this->_sections['bms_no']['loop'];
$this->_sections['bms_no']['start'] = $this->_sections['bms_no']['step'] > 0 ? 0 : $this->_sections['bms_no']['loop']-1;
if ($this->_sections['bms_no']['show']) {
    $this->_sections['bms_no']['total'] = min(ceil(($this->_sections['bms_no']['step'] > 0 ? $this->_sections['bms_no']['loop'] - $this->_sections['bms_no']['start'] : $this->_sections['bms_no']['start']+1)/abs($this->_sections['bms_no']['step'])), $this->_sections['bms_no']['max']);
    if ($this->_sections['bms_no']['total'] == 0)
        $this->_sections['bms_no']['show'] = false;
} else
    $this->_sections['bms_no']['total'] = 0;
if ($this->_sections['bms_no']['show']):

            for ($this->_sections['bms_no']['index'] = $this->_sections['bms_no']['start'], $this->_sections['bms_no']['iteration'] = 1;
                 $this->_sections['bms_no']['iteration'] <= $this->_sections['bms_no']['total'];
                 $this->_sections['bms_no']['index'] += $this->_sections['bms_no']['step'], $this->_sections['bms_no']['iteration']++):
$this->_sections['bms_no']['rownum'] = $this->_sections['bms_no']['iteration'];
$this->_sections['bms_no']['index_prev'] = $this->_sections['bms_no']['index'] - $this->_sections['bms_no']['step'];
$this->_sections['bms_no']['index_next'] = $this->_sections['bms_no']['index'] + $this->_sections['bms_no']['step'];
$this->_sections['bms_no']['first']      = ($this->_sections['bms_no']['iteration'] == 1);
$this->_sections['bms_no']['last']       = ($this->_sections['bms_no']['iteration'] == $this->_sections['bms_no']['total']);
?>
                            <tr>
                                <th>
                                    <span class="point"><?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['point'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</span> / <span class="impre"><?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['imp'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</span>
                                </th>
                                <td>
                                    <p class="genre">【 <?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['genre'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 】</p>
                                    <p class="title"><a href="detail/view/<?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['rowid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/"><?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</a></p>
                                    <p class="artist"><?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['artist'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</p>
                                </td>
                            </tr>
                        <?php endfor; endif; ?>
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