<?php /* Smarty version 2.6.28, created on 2015-11-23 01:10:09
         compiled from admin/admin_mainmenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', 'admin/admin_mainmenu.tpl', 20, false),)), $this); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Another B.J.Cup Stage #01:Alternative</title>
	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
</head>

<body>
    <h2>管理メニュー</h2>
    <p><a href="<?php echo $this->_tpl_vars['root_url']; ?>
/admin/infoform/">インフォメーション欄を編集する</a> / <a href="<?php echo $this->_tpl_vars['root_url']; ?>
/admin/scheduleform/">スケジュールを変更する</a></p>
    
    <table border="1">
        <tr><th>No.</th><th>タイトル / 作者名</th><th>作品情報編集・削除フォームへ</th><th>インプレ編集メニューへ</th></tr>
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
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['rowid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
.</td>
            <td><?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['title'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
 / <?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['artist'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
</td>
            <td><a href='<?php echo $this->_tpl_vars['root_url']; ?>
/admin/bmseditform/<?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['rowid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/'>GO</a></td>
            <td><a href='<?php echo $this->_tpl_vars['root_url']; ?>
/admin/impmenu/<?php echo ((is_array($_tmp=$this->_tpl_vars['bms_data'][$this->_sections['bms_no']['index']]['rowid'])) ? $this->_run_mod_handler('escape', true, $_tmp) : smarty_modifier_escape($_tmp)); ?>
/'>GO</a></td>
        </tr>
        <?php endfor; endif; ?>
    </table>
    
    <form action="<?php echo $this->_tpl_vars['root_url']; ?>
/admin/changemasterpass/" method="POST">
        <p>管理パスワードを変更 : <input type="password" name="password" size="8"><button type="submit" name="mode" value="changemasterpass">変更</button></p>
    </form>
</body>
</html>