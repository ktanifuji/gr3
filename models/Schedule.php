<?php

class Schedule extends ModelBase
{

    public function __construct()
    {
        $db_file_name = 'db/schedule.sqlite3';
                
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
        $sth1 = $this->dblink->prepare("CREATE TABLE schedule (name, start, end)");
        $this->write_sql($sth1);

        $sth2 = $this->dblink->prepare("INSERT INTO schedule VALUES ('entry', '2015/01/01', '2015/12/31')");
        $this->write_sql($sth2);

        $sth3 = $this->dblink->prepare("INSERT INTO schedule VALUES ('genre', '2015/01/01', '2015/12/31')");
        $this->write_sql($sth3);

        $sth4 = $this->dblink->prepare("INSERT INTO schedule VALUES ('regist', '2016/01/01', '2016/12/31')");
        $this->write_sql($sth4);

        $sth5 = $this->dblink->prepare("INSERT INTO schedule VALUES ('impre', '2016/01/01', '2016/12/31')");
        $this->write_sql($sth5);
    }

    private function check_schedule_format($time)
    {
        if (!preg_match('/^\d\d\d\d\/\d\d\/\d\d \d\d:\d\d:\d\d$/', $time))
        {
            throw new Exception('「yyyy/mm/dd hh:mm:ss」の形式で入力してください');
        }
    }

    private function update_schedule($name, $start, $end)
    {
        $this->check_schedule_format($start);
        $this->check_schedule_format($end);

        $sth = $this->dblink->prepare("UPDATE schedule SET start = ?, end = ? WHERE name = ?");
        $sth->bindParam(1, $start, PDO::PARAM_STR);
        $sth->bindParam(2, $end, PDO::PARAM_STR);
        $sth->bindParam(3, $name, PDO::PARAM_STR);
        $this->write_sql($sth);
    }

    public function update($post)
    {
        $this->update_schedule('entry', $post['entry_start'], $post['entry_end']);
        $this->update_schedule('genre', $post['genre_start'], $post['genre_end']);
        $this->update_schedule('regist', $post['regist_start'], $post['regist_end']);
        $this->update_schedule('impre', $post['impression_start'], $post['impression_end']);
    }

    public function get($name)
    {
        $sth = $this->dblink->prepare("SELECT start, end FROM schedule WHERE name = ?");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->bindParam(1, $name, PDO::PARAM_STR);
        $sth->execute();
        $schedule = $sth->fetch();

        return $schedule;
    }

    public function is_in_time($name, $current_time)
    {
        $schedule = $this->get($name);
        return ($current_time >= $schedule['start'] && $current_time < $schedule['end']);
    }

}
