<?php

class Impression extends ModelBase
{

    public function __construct($no)
    {
        $db_file_name = sprintf('db/impression%d.sqlite3', $no);
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
        $sth = $this->dblink->prepare("CREATE TABLE impression (name, site_url, email, point, comment, post_time, ip, host, user_id)");
        $this->write_sql($sth);
    }

    public function post($post, $post_time, $ip, $host)
    {
        $post = $this->check_post($post);
        
        // ID生成
        $salt = "al";
        $user_id = substr(crypt($ip . $host, $salt), 2);

        $sth = $this->dblink->prepare("INSERT INTO impression VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sth->bindParam(1, $post['name'], PDO::PARAM_STR);
        $sth->bindParam(2, $post['site_url'], PDO::PARAM_STR);
        $sth->bindParam(3, $post['email'], PDO::PARAM_STR);
        $sth->bindParam(4, $post['point'], PDO::PARAM_INT);
        $sth->bindParam(5, $post['comment'], PDO::PARAM_STR);
        $sth->bindParam(6, $post_time, PDO::PARAM_STR);
        $sth->bindParam(7, $ip, PDO::PARAM_STR);
        $sth->bindParam(8, $host, PDO::PARAM_STR);
        $sth->bindParam(9, $user_id, PDO::PARAM_STR);
        
        $this->write_sql($sth);
    }
    
    public function update($post)
    {
        $post = $this->check_post($post);

        $sth = $this->dblink->prepare("UPDATE impression SET name = ?, site_url = ?, email = ?, point = ?, comment = ? WHERE rowid = ?");
        $sth->bindParam(1, $post['name'], PDO::PARAM_STR);
        $sth->bindParam(2, $post['site_url'], PDO::PARAM_STR);
        $sth->bindParam(3, $post['email'], PDO::PARAM_STR);
        $sth->bindParam(4, $post['point'], PDO::PARAM_INT);
        $sth->bindParam(5, $post['comment'], PDO::PARAM_STR);
        
        $sth->bindParam(6, $post['imp_no'], PDO::PARAM_INT);
        
        $this->write_sql($sth);
    }
    
    public function delete($imp_no)
    {
        $sth = $this->dblink->prepare("DELETE FROM impression WHERE rowid = ?");
        $sth->bindParam(1, $imp_no, PDO::PARAM_INT);

        $this->write_sql($sth);
    }

    public function get_data($imp_no = null)
    {
        if ($imp_no === null)
        {
            $result = $this->dblink->query('SELECT rowid, * FROM impression');

            $data = array();
            $i = 0;
            while ($temp = $result->fetch(PDO::FETCH_ASSOC))
            {
                $data[$i] = $temp;
                $i++;
            }

            return $data;
        }
        else
        {
            $sth = $this->dblink->prepare("SELECT * FROM impression WHERE rowid = ?");
            $sth->setFetchMode(PDO::FETCH_ASSOC);
            $sth->bindParam(1, $imp_no, PDO::PARAM_INT);
            $sth->execute();

            $data = $sth->fetch();
            if ($data === FALSE)
            {
                throw new Exception('該当のインプレッションが見当たりません');
            }
            return $data;
        }
    }

    private function check_post($post)
    {
        if (preg_match('/^(\x81\x40|\s)+$/', $post['name']))
        {
            throw new Exception('名前は正しく記入してください');
        }
        if ($post['name'] == "")
        {
            throw new Exception('名前は記入必須です');
        }
        
        if ($post['email'] && !preg_match('/[\w\.\-]+\@[\w\.\-]+\.[a-zA-Z]{2,6}$/', $post['email']))
        {
            throw new Exception("E-mailの入力内容が不正です");
        }
        
        if ($post['site_url'] === (string) "http://")
        {
            $post['site_url'] = "";
        }
        
        if ($post['point'] == "")
        {
            throw new Exception('ポイントは記入必須です');
        }
        
        if (preg_match('/^(\x81\x40|\s|<br>)+$/', $post['comment']))
        {
            throw new Exception('コメントは正しく記入してください');
        }
        
        return $post;
    }

}
