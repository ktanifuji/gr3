<?php

class Master extends ModelBase
{

    public function __construct()
    {
        $db_file_name = 'db/event.sqlite3';
        
        if (!file_exists($db_file_name))
        {
            $this->linkDB($db_file_name);
            $this->create();
        }
        else
        {
            $this->linkDB($db_file_name);
        }
    }

    private function create()
    {
        $sth1 = $this->dblink->prepare("CREATE TABLE event (name, value)");
        $this->write_sql($sth1);

        $sth2 = $this->dblink->prepare("INSERT INTO event VALUES ('info', 'ここにインフォメーション文が入ります。')");
        $this->write_sql($sth2);

        $sth3 = $this->dblink->prepare("INSERT INTO event VALUES ('master', ?)");
        $hashed_pwd = blowfish('admin');
        $sth3->bindParam(1, $hashed_pwd, PDO::PARAM_STR);
        $this->write_sql($sth3);

        $sth4 = $this->dblink->prepare("INSERT INTO event VALUES ('visible_point', 0)");
        $this->write_sql($sth4);
    }

    public function update_info($info)
    {
        if (preg_match('/^(\x81\x40|\s|<br>)+$/', $info))
        {
            throw new Exception('インフォメーションは正しく記入してください');
        }

        $sth = $this->dblink->prepare("UPDATE event SET value = ? WHERE name = 'info'");
        $sth->bindParam(1, $info, PDO::PARAM_STR);
        $this->write_sql($sth);
    }

    public function change_pwd($pwd)
    {
        $sth = $this->dblink->prepare("UPDATE event SET value = ? WHERE name = 'master'");

        $hashed_pwd = blowfish($pwd);

        $sth->bindParam(1, $hashed_pwd, PDO::PARAM_STR);
        $this->write_sql($sth);
    }

    public function change_view_mode($visible_point)
    {
        $sth = $this->dblink->prepare("UPDATE event SET value = ? WHERE name = 'visible_point'");

        $sth->bindParam(1, $visible_point, PDO::PARAM_INT);
        $this->write_sql($sth);
    }

    public function is_matching_pass($pwd)
    {
        $sql = "SELECT value FROM event WHERE name = 'master'";
        $result = $this->dblink->query($sql);
        $adminpass = $result->fetch(PDO::FETCH_ASSOC);
        
        return crypt($pwd, $adminpass['value']) === $adminpass['value'];
    }

    public function is_visible_point()
    {
        $sql = "SELECT value FROM event WHERE name = 'visible_point'";
        $result = $this->dblink->query($sql);
        $visible_point = $result->fetch(PDO::FETCH_ASSOC);

        return $visible_point['value'] == 1;
    }

    public function get_info()
    {
        $sql = "SELECT value FROM event WHERE name='info'";
        $result = $this->dblink->query($sql);
        $infodata = $result->fetch(PDO::FETCH_ASSOC);

        return $infodata['value'];
    }

}
