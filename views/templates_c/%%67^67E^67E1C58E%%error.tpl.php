<?php /* Smarty version 2.6.28, created on 2015-11-22 21:06:10
         compiled from error.tpl */ ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="ja">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>GENRE-SHUFFLE3</title>
        <link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['root_url']; ?>
/common/css/style.css">
        <link href='http://fonts.googleapis.com/css?family=Allerta+Stencil' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Arvo:regular,bold' rel='stylesheet' type='text/css'>
        <!--[if lt IE 9]>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="container">
            <div id="main">
                <div id="event-detail">
                    <div id="info">
                        ERROR!<br>
                        <?php echo $this->_tpl_vars['msg']; ?>

                    </div>
                    <form>
                        <input type=button value="back" onClick="history.back();">
                    </form>
                </div>
            </div>
            <div id="footer">
                <p><a href="<?php echo $this->_tpl_vars['root_url']; ?>
" />Colosseo @ 2011-2015</a></p>
            </div><!-- footer -->
        </div>
    </body>
</html>