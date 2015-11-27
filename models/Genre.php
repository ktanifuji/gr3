<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Genre
 *
 * @author Akihito
 */
class Genre extends ModelBase
{
    public function __construct()
    {
        $db_file_name = 'db/genre.sqlite3';
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
        $sth = $this->dblink->prepare("CREATE TABLE info (genre, name, twitter_id, entry_time, ip, host)");
        $this->write_sql($sth);
    }
    
    public function add($post, $entry_time, $ip, $host)
    {
        /*
        if($this->is_double_post($ip, $host))
        {
            throw new Exception('ジャンル応募は1人1回です。');
        }
        */
        $checked_post = $this->check_post($post);
        
        if($this->is_already_entried($checked_post['genre']))
        {
            throw new Exception('そのジャンルはすでに応募されているようです。');
        }

        $sth = $this->dblink->prepare("INSERT INTO info VALUES (?, ?, ?, ?, ?, ?)");
        $sth->bindParam(1, $checked_post['genre'], PDO::PARAM_STR);
        $sth->bindParam(2, $checked_post['name'], PDO::PARAM_STR);
        $sth->bindParam(3, $checked_post['twitter_id'], PDO::PARAM_STR);
        $sth->bindParam(4, $entry_time, PDO::PARAM_STR);
        $sth->bindParam(5, $ip, PDO::PARAM_STR);
        $sth->bindParam(6, $host, PDO::PARAM_STR);
        
        $this->write_sql($sth);
    }
    
    public function revise($post, $revise_time, $ip, $host)
    {
        $checked_post = $this->check_post($post);

        $sth = $this->dblink->prepare(
                "UPDATE info SET genre = ?, name = ?, twitter_id = ? WHERE rowid = ?");
        $sth->bindParam(1, $checked_post['genre'], PDO::PARAM_STR);
        $sth->bindParam(2, $checked_post['name'], PDO::PARAM_STR);
        $sth->bindParam(3, $checked_post['twitter_id'], PDO::PARAM_STR);
        
        $sth->bindParam(4, $checked_post['entry_no'], PDO::PARAM_INT);

        $this->write_sql($sth);
    }
    
    public function delete($entry_no)
    {
        $sth = $this->dblink->prepare("DELETE FROM info WHERE rowid = ?");
        $sth->bindParam(1, $entry_no, PDO::PARAM_INT);
        $this->write_sql($sth);
    }
    
    public function get_data($entry_no = null)
    {
        if ($entry_no === null)
        {
            $result = $this->dblink->query('SELECT rowid, * FROM info');

            $rows = array();
            $i = 0;
            while ($data = $result->fetch(PDO::FETCH_ASSOC))
            {
                $rows[$i] = $data;
                $i++;
            }
            return $rows;
        }
        else
        {
            $sth = $this->dblink->prepare("SELECT * FROM info WHERE rowid = ?");
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->bindParam(1, $entry_no, PDO::PARAM_INT);
            $sth->execute();

            $data = $sth->fetch();
            if ($data === FALSE)
            {
                throw new Exception('該当の作品がリストに見当たりません');
            }
            return $data;
        }
    }
    
    private function check_post($post)
    {
        if ($post['genre'] === "")
        {
            throw new Exception("ジャンルは記入必須です");
        }
        if (preg_match('/^(\x81\x40|\s)+$/', $post['genre']))
        {
            throw new Exception("ジャンルは正しく記入してください");
        }
        
        if (preg_match('/^(\x81\x40|\s)+$/', $post['name']))
        {
            throw new Exception("名前は正しく記入してください");
        }
        
        if (preg_match('/^(\x81\x40|\s)+$/', $post['twitter_id']))
        {
            throw new Exception("TwitterIDは正しく記入してください");
        }
        $post['twitter_id'] = str_replace('@', '', $post['twitter_id']);
        
        
        if ($post['name'] === "" && $post['twitter_id'] === "")
        {
            throw new Exception("名前かTwitterIDは記入必須です");
        }
        
        return $post;
    }
    
    private function is_double_post($ip, $host)
    {
        $sth = $this->dblink->prepare("SELECT * FROM info WHERE ip = ? AND host = ?");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->bindParam(1, $ip, PDO::PARAM_STR);
        $sth->bindParam(2, $host, PDO::PARAM_STR);
        $sth->execute();
        $data = $sth->fetch();
        
        return ($data != FALSE);
    }
    
    private function is_already_entried($genre)
    {
        $sth = $this->dblink->prepare("SELECT * FROM info WHERE genre COLLATE nocase = ?");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->bindParam(1, $genre, PDO::PARAM_STR);
        $sth->execute();
        $data = $sth->fetch();
        
        return ($data != FALSE);
    }
}
