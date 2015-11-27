<?php

//ファイルロッククラス
class FileLock
{

    private $lockdir;  //ロックファイル用ディレクトリ(最後に/はなし)
    private $timeout;  //タイムアウト時間(秒、float)
    private $sleeptime;  //スリープ時間(秒、float)

    //コンストラクタ

    public function __construct($lockdir = '.', $timeout = 10.0, $sleeptime = 0.1)
    {
        if (substr($lockdir, -1) === '/')
        {
            $lockdir = substr($lockdir, 0, strlen($lockdir) - 1);//末尾の/を削る
        } 
        $this->lockdir = $lockdir;
        $this->timeout = $timeout;
        $this->sleeptime = $sleeptime;
    }

    //ロック用関数
    public function lock($filename)
    {
        $lockfile = $this->lockdir . DIRECTORY_SEPARATOR . basename($filename) . '.lock';

        //ロックファイルがタイムアウト時間を過ぎて存在し続けていたら削除
        if (file_exists($lockfile))
        {
            if (microtime(true) - filemtime($lockfile) > $this->timeout)
            {
                $this->unlock($filename);
            }
        }

        //ロックをかける
        $start = microtime(true);
        while (!@mkdir($lockfile, 0755))
        {
            if (microtime(true) - $start > $this->timeout)
            {
                //タイムアウト時間を過ぎたのでロック失敗
                return false;
            }
            usleep($this->sleeptime * 1000 * 1000);
        }

        return true;
    }

    //ロック解除用
    public function unlock($filename)
    {
        $lockfile = $this->lockdir . DIRECTORY_SEPARATOR . basename($filename) . '.lock';
        @rmdir($lockfile);
    }

}
