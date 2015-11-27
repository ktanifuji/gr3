<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Entry
 *
 * @author Akihito
 */
class Entry extends ModelBase
{

    public function __construct()
    {
        $db_file_name = 'db/entry.sqlite3';
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
        $sth = $this->dblink->prepare("CREATE TABLE info (artist, email, twitter_id, site_url, entry_time, password, ip, host)");
        $this->write_sql($sth);
    }

    public function add($post, $entry_time, $ip, $host)
    {
        $checked_post = $this->check_post($post);
        /*
        if($this->is_double_post($checked_post['artist'], $ip, $host))
        {
            throw new Exception('多重エントリーです。');
        }
        */
        // pass暗号化
        if ($post['password'] === "")
        {
            throw new Exception("パスワードは入力必須です");
        }
        $hashed_pwd = blowfish($post['password']);

        $sth = $this->dblink->prepare("INSERT INTO info VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $sth->bindParam(1, $checked_post['artist'], PDO::PARAM_STR);
        $sth->bindParam(2, $checked_post['email'], PDO::PARAM_STR);
        $sth->bindParam(3, $checked_post['twitter_id'], PDO::PARAM_STR);
        $sth->bindParam(4, $checked_post['site_url'], PDO::PARAM_STR);
        $sth->bindParam(5, $entry_time, PDO::PARAM_STR);
        $sth->bindParam(6, $hashed_pwd, PDO::PARAM_STR);
        $sth->bindParam(7, $ip, PDO::PARAM_STR);
        $sth->bindParam(8, $host, PDO::PARAM_STR);

        $this->write_sql($sth);
    }

    public function change_pwd($post)
    {
        if ($post['password'] === (string) "")
        {
            throw new Exception("パスワードは入力必須です");
        }

        $hashed_pwd = blowfish($post['password']);

        $sth = $this->dblink->prepare("UPDATE info SET password = ? WHERE rowid = ?");
        $sth->bindParam(1, $hashed_pwd, PDO::PARAM_STR);
        $sth->bindParam(2, $post['entry_no'], PDO::PARAM_INT);

        $this->write_sql($sth);
    }

    public function revise($post, $revise_time, $ip, $host)
    {
        $checked_post = $this->check_post($post);

        $sth = $this->dblink->prepare(
                "UPDATE info SET artist = ?, email = ?, twitter_id = ?, site_url = ? WHERE rowid = ?");
        $sth->bindParam(1, $checked_post['artist'], PDO::PARAM_STR);
        $sth->bindParam(2, $checked_post['email'], PDO::PARAM_STR);
        $sth->bindParam(3, $checked_post['twitter_id'], PDO::PARAM_STR);
        $sth->bindParam(4, $checked_post['site_url'], PDO::PARAM_STR);

        $sth->bindParam(5, $checked_post['entry_no'], PDO::PARAM_INT);

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
        if ($post['artist'] === "")
        {
            throw new Exception("アーティスト名は記入必須です");
        }
        if (preg_match('/^(\x81\x40|\s)+$/', $post['artist']))
        {
            throw new Exception("アーティスト名は正しく記入してください");
        }

        if ($post['email'] && !preg_match('/[\w\.\-]+\@[\w\.\-]+\.[a-zA-Z]{2,6}$/', $post['email']))
        {
            throw new Exception("E-mailの入力内容が不正です");
        }

        if (preg_match('/^(\x81\x40|\s)+$/', $post['twitter_id']))
        {
            throw new Exception("TwitterIDは正しく記入してください");
        }
        $post['twitter_id'] = str_replace('@', '', $post['twitter_id']);

        if ($post['site_url'] === (string) "http://")
        {
            $post['site_url'] = "";
        }

        return $post;
    }
    
    private function is_double_post($artist, $ip, $host)
    {
        $sth = $this->dblink->prepare("SELECT * FROM info WHERE artist = ? AND ip = ? AND host = ?");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->bindParam(1, $artist, PDO::PARAM_STR);
        $sth->bindParam(2, $ip, PDO::PARAM_STR);
        $sth->bindParam(3, $host, PDO::PARAM_STR);
        $sth->execute();
        $data = $sth->fetch();
        
        return ($data != FALSE);
    }
}
