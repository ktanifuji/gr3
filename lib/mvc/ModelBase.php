<?php

abstract class ModelBase
{

    protected $dblink;
    protected $filename;

    protected function linkDB($filename)
    {
        $this->filename = $filename;
        $dsn = 'sqlite:' . $filename;
        $this->dblink = new PDO($dsn);
        $this->dblink->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->dblink->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

    protected function write_sql($sth)
    {
        $flock = new FileLock('db/lock');

        if ($flock->lock($this->filename))
        {
            $sth->execute();
            $flock->unlock($this->filename);
        }
        else
        {
            throw new Exception('ファイルに書き込めませんでした。');
        }
    }

}
