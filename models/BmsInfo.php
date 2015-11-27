<?php

class BmsInfo extends ModelBase
{

    public function __construct()
    {
        $db_file_name = 'db/bms_info.sqlite3';
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
        $sth = $this->dblink->prepare("CREATE TABLE info (genre, title, artist, point, imp, dl_count, email, site_url, bga, min_level, max_level, bpm, comment, dl_url, size, listen_url, post_time, password, ip, host, user_id)");
        $this->write_sql($sth);
    }
    
    private function is_in_time($current_time, $start_time, $end_time)
    {
        return ($current_time >= $start_time && $current_time < $end_time);
    }

    public function register($post, $registration_time, $ip, $host)
    {
        $post = $this->check_post($post);

        // pass暗号化
        if (!isset($post['password'])){ throw new Exception("パスワードは入力必須です");}
        $hashed_pwd = blowfish($post['password']);
        
        // ID生成
        $salt = "al";
        $user_id = substr(crypt($ip . $host, $salt), 2);

        $sth = $this->dblink->prepare("INSERT INTO info VALUES (?, ?, ?, 0, 0, 0, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $sth->bindParam(1, $post['genre'], PDO::PARAM_STR);
        $sth->bindParam(2, $post['title'], PDO::PARAM_STR);
        $sth->bindParam(3, $post['artist'], PDO::PARAM_STR);
        
        $sth->bindParam(4, $post['email'], PDO::PARAM_STR);
        $sth->bindParam(5, $post['site_url'], PDO::PARAM_STR);
        $sth->bindParam(6, $post['bga'], PDO::PARAM_STR);
        $sth->bindParam(7, $post['min_level'], PDO::PARAM_STR);
        $sth->bindParam(8, $post['max_level'], PDO::PARAM_STR);
        $sth->bindParam(9, $post['bpm'], PDO::PARAM_STR);
        $sth->bindParam(10, $post['comment'], PDO::PARAM_STR);
        $sth->bindParam(11, $post['dl_url'], PDO::PARAM_STR);
        $sth->bindParam(12, $post['size'], PDO::PARAM_STR);
        $sth->bindParam(13, $post['listen_url'], PDO::PARAM_STR);
        $sth->bindParam(14, $registration_time, PDO::PARAM_STR);
        $sth->bindParam(15, $hashed_pwd, PDO::PARAM_STR);
        $sth->bindParam(16, $ip, PDO::PARAM_STR);
        $sth->bindParam(17, $host, PDO::PARAM_STR);
        $sth->bindParam(18, $user_id, PDO::PARAM_STR);

        $this->write_sql($sth);
    }

    public function revise($post, $modify_time, $ip, $host)
    {
        $post = $this->check_post($post);

        $sth = $this->dblink->prepare(
                "UPDATE info SET genre = ?, title = ?, artist = ?, email = ?, site_url = ?, bga = ?, min_level = ?, max_level = ?, bpm = ?, comment = ?, dl_url = ?, size = ?, listen_url = ? WHERE rowid = ?");
        $sth->bindParam(1, $post['genre'], PDO::PARAM_STR);
        $sth->bindParam(2, $post['title'], PDO::PARAM_STR);
        $sth->bindParam(3, $post['artist'], PDO::PARAM_STR);
        $sth->bindParam(4, $post['email'], PDO::PARAM_STR);
        $sth->bindParam(5, $post['site_url'], PDO::PARAM_STR);
        $sth->bindParam(6, $post['bga'], PDO::PARAM_STR);
        $sth->bindParam(7, $post['min_level'], PDO::PARAM_STR);
        $sth->bindParam(8, $post['max_level'], PDO::PARAM_STR);
        $sth->bindParam(9, $post['bpm'], PDO::PARAM_STR);
        $sth->bindParam(10, $post['comment'], PDO::PARAM_STR);
        $sth->bindParam(11, $post['dl_url'], PDO::PARAM_STR);
        $sth->bindParam(12, $post['size'], PDO::PARAM_STR);
        $sth->bindParam(13, $post['listen_url'], PDO::PARAM_STR);
        
        $sth->bindParam(14, $post['bms_no'], PDO::PARAM_INT);

        $this->write_sql($sth);
    }

    public function update_by_impression($bms_no, $point, $update_time)
    {
        $sth = $this->dblink->prepare("SELECT point, imp FROM info WHERE rowid = ?");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->bindParam(1, $bms_no, PDO::PARAM_INT);
        $sth->execute();

        $registdata = $sth->fetch();
        if ($registdata)
        {
            //得点を更新
            $nowpoint = $registdata['point'] + $point;
            $nowimp = $registdata['imp'] + 1;
            $sth = $this->dblink->prepare("UPDATE info SET point = ?, imp = ? WHERE rowid = ?");
            $sth->bindParam(1, $nowpoint, PDO::PARAM_INT);
            $sth->bindParam(2, $nowimp, PDO::PARAM_INT);
            $sth->bindParam(3, $bms_no, PDO::PARAM_INT);

            $this->write_sql($sth);
        }
        else
        {
            throw new Exception('該当の作品がリストに見当たりません');
        }
    }

    public function update_by_impression_edit($bms_no, $prev_point, $new_point)
    {
        $sth = $this->dblink->prepare("SELECT point FROM info WHERE rowid = ?");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->bindParam(1, $bms_no, PDO::PARAM_INT);
        $sth->execute();
        
        $prev_data = $sth->fetch();
        if ($prev_data)
        {
            $updated_point = $prev_data['point'] - $prev_point + $new_point;
            
            $sth = $this->dblink->prepare("UPDATE info SET point = ? WHERE rowid = ?");
            $sth->bindParam(1, $updated_point, PDO::PARAM_INT);
            $sth->bindParam(2, $bms_no, PDO::PARAM_INT);

            $this->write_sql($sth);
        }
        else
        {
            throw new Exception('該当データがありません');
        }
    }
    
    public function update_by_impression_delete($bms_no, $del_point)
    {
        $sth = $this->dblink->prepare("SELECT point, imp FROM info WHERE rowid = ?");
        $sth->setFetchMode(PDO::FETCH_ASSOC);
        $sth->bindParam(1, $bms_no, PDO::PARAM_INT);
        $sth->execute();
        
        $prev_data = $sth->fetch();
        if ($prev_data)
        {
            $updated_point = $prev_data['point'] - $del_point;
            $updated_imp = $prev_data['imp'] - 1;
            
            $sth = $this->dblink->prepare("UPDATE info SET point = ?, imp = ? WHERE rowid = ?");
            $sth->bindParam(1, $updated_point, PDO::PARAM_INT);
            $sth->bindParam(2, $updated_imp, PDO::PARAM_INT);
            $sth->bindParam(3, $bms_no, PDO::PARAM_INT);

            $this->write_sql($sth);
        }
        else
        {
            throw new Exception('該当データがありません');
        }
    }

    public function delete($bms_no)
    {
        $sth = $this->dblink->prepare("DELETE FROM info WHERE rowid = ?");
        $sth->bindParam(1, $bms_no, PDO::PARAM_INT);
        $this->write_sql($sth);
    }
    
    public function change_password($post)
    {
        if ($post['password'] === (string) "")
        {
            throw new Exception("パスワードは入力必須です");
        }
        
        $hashed_pwd = blowfish($post['password']);
        
        $sth = $this->dblink->prepare("UPDATE info SET password = ? WHERE rowid = ?");
        $sth->bindParam(1, $hashed_pwd, PDO::PARAM_INT);
        $sth->bindParam(2, $post['bms_no'], PDO::PARAM_INT);

        $this->write_sql($sth);
    }

    public function get_data($bms_no = null)
    {
        if ($bms_no === null)
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
            $sth->bindParam(1, $bms_no, PDO::PARAM_INT);
            $sth->execute();

            $data = $sth->fetch();
            if ($data === FALSE)
            {
                throw new Exception('該当の作品がリストに見当たりません');
            }
            return $data;
        }
    }

    public function get_last_id()
    {
        $sql = 'SELECT rowid FROM info ORDER BY rowid DESC LIMIT 1';
        $result = $this->dblink->query($sql);
        $data = $result->fetch(PDO::FETCH_ASSOC);
        return $data['rowid'];
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
        
        if ($post['title'] === "")
        {
            throw new Exception("タイトルは記入必須です");
        }
        if (preg_match('/^(\x81\x40|\s)+$/', $post['title']))
        {
            throw new Exception("タイトルは正しく記入してください");
        }
        
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
        
        if ($post['site_url'] === (string) "http://")
        {
            $post['site_url'] = "";
        }
        
        if ($post['bpm'] === "")
        {
            throw new Exception("BPMは記入必須です");
        }
        if (preg_match('/^(\x81\x40|\s)+$/', $post['bpm']))
        {
            throw new Exception("BPMは正しく記入してください");
        }
        
        if (strlen($post['comment']) > 4000)
        {
            throw new Exception("コメントが長すぎます。<br>全角2000文字以内で記述してください。");
        }
        if (preg_match('/^(\x81\x40|\s|<br>)+$/', $post['comment']))
        {
            throw new Exception("コメントは正しく記入してください");
        }
        if ($post['comment'] === "")
        {
            throw new Exception("コメントの内容がありません");
        }
        
        if (preg_match('/^(\x81\x40|\s)+$/', $post['dl_url']))
        {
            throw new Exception("ダウンロードURLは正しく記入してください");
        }
        if ($post['dl_url'] === (string) "http://")
        {
            $post['dl_url'] = "";
        }
        if ($post['dl_url'] === (string) "")
        {
            throw new Exception("ダウンロードURLは記入必須です");
        }
        
        if ($post['size'] === "")
        {
            throw new Exception("サイズは記入必須です");
        }
        if (preg_match('/^(\x81\x40|\s)+$/', $post['size']))
        {
            throw new Exception("サイズは正しく記入してください");
        }

        if ($post['listen_url'] === (string) "http://")
        {
            $post['listen_url'] = "";
        }

        return $post;
    }

}
