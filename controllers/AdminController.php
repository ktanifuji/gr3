<?php

class AdminController extends ControllerBase
{
    private function checkLogin()
    {
        session_start();
        if (!isset($_SESSION["admin_mode"]))
        {
            header("Location:". ROOT_URL ."/admin/");
        }
    }
    
    public function indexAction()
    {
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('admin/admin_login.tpl');
    }

    public function loginAction()
    {
        try
        {
            session_start();
            
            $master = new Master();
            if (!$master->is_matching_pass($this->request->getPost('password')))
            {
                throw new Exception('パスワードが一致しません');
            }
            
            
            $_SESSION["admin_mode"] = true;
            header("Location: ". ROOT_URL ."/admin/mainmenu/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function mainmenuAction()
    {
        try
        {
            $this->checkLogin();
            $bms_info = new BmsInfo();
            $bms_data = $bms_info->get_data();
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
        $this->view->assign('bms_data', $bms_data);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('admin/admin_mainmenu.tpl');
    }

    public function infoformAction()
    {
        try
        {
            $this->checkLogin();
            $master = new Master();
            $info_message = $master->get_info();
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
        $this->view->assign('info_message', $info_message);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('admin/admin_infoform.tpl');
    }

    public function editinfoAction()
    {
        try
        {
            $this->checkLogin();
            $master = new Master();
            $master->update_info($this->request->getPost('info'));
            header("Location: ". ROOT_URL . "/admin/finish/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function scheduleformAction()
    {
        try
        {
            $this->checkLogin();
            $schedule = new Schedule();
            $this->view->assign('regist_schedule', $schedule->get('regist'));
            $this->view->assign('impression_schedule', $schedule->get('impre'));
            $this->view->assign('root_url', ROOT_URL);
            $this->view->display('admin/admin_scheduleform.tpl');
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function editscheduleAction()
    {
        try
        {
            $this->checkLogin();
            $schedule = new Schedule;
            $schedule->update($this->request->getPost());

            header("Location: " . ROOT_URL . "/admin/finish/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function bmseditformAction()
    {
        try
        {
            $this->checkLogin();
            if (($bms_no = $this->request->getParam('0')) == null)
            {
                throw new Exception('不正なリクエストです。');
            }

            $bms_info = new BmsInfo();
            $bms_data = $bms_info->get_data($bms_no);
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
        $this->view->assign('bms_no', $bms_no);
        $this->view->assign('bms_data', $bms_data);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('admin/admin_bmseditform.tpl');
    }

    public function editbmsAction()
    {
        try
        {
            $this->checkLogin();
            $bms_info = new BmsInfo();
            $bms_info->revise($this->request->getPost(), $this->current_time, $this->ip, $this->host);

            header("Location: ". ROOT_URL ."/admin/finish/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function deletebmsAction()
    {
        try
        {
            $this->checkLogin();
            $bms_info = new BmsInfo();
            $bms_info->delete($this->request->getPost('bms_no'));

            header("Location: ".ROOT_URL."/admin/finish/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function impmenuAction()
    {
        try
        {
            $this->checkLogin();
            $bms_no = $this->request->getParam('0');

            if (!file_exists("db/impression$bms_no.sqlite3"))
            {
                throw new Exception('該当データがありません');
            }
            $impression = new Impression($bms_no);
            $impression_data = $impression->get_data();
        }
        catch (Exception $ex)
        {
            $this->displayErrorView($ex->getMessage());
        }

        $this->view->assign('bms_no', $bms_no);
        $this->view->assign('impression_data', $impression_data);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('admin/admin_impmenu.tpl');
    }

    public function impformAction()
    {
        try
        {
            $this->checkLogin();
            $bms_no = $this->request->getParam('0');

            if (!file_exists("db/impression$bms_no.sqlite3"))
            {
                throw new Exception('該当データがありません');
            }

            $imp_no = $this->request->getParam('1');

            $impression = new Impression($bms_no);
            $impression_data = $impression->get_data($imp_no);
        }
        catch (Exception $ex)
        {
            $this->displayErrorView($ex->getMessage());
        }

        $this->view->assign('bms_no', $bms_no);
        $this->view->assign('imp_no', $imp_no);
        $this->view->assign('impression_data', $impression_data);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('admin/admin_impform.tpl');
    }

    public function editimpAction()
    {
        try
        {
            $this->checkLogin();
            $bms_no = $this->request->getPost('bms_no');
            $imp_no = $this->request->getPost('imp_no');

            $impression = new Impression($bms_no);

            $impression_data = $impression->get_data($imp_no);

            $impression->update($this->request->getPost());

            $prev_point = $impression_data['point'];
            $new_point = $this->request->getPost('point');
            
            $bms_info = new BmsInfo();
            $bms_info->update_by_impression_edit($bms_no, $prev_point, $new_point);

            header("Location: ".ROOT_URL."/admin/finish/");
        }
        catch (Exception $ex)
        {
            $this->displayErrorView($ex->getMessage());
        }
    }

    public function deleteimpAction()
    {
        try
        {
            $this->checkLogin();
            $bms_no = $this->request->getPost('bms_no');
            $imp_no = $this->request->getPost('imp_no');

            $impression = new Impression($bms_no);
            $impression_data = $impression->get_data($imp_no);
            $del_point = $impression_data['point'];

            $impression->delete($imp_no);

            $bms_info = new BmsInfo();
            $bms_info->update_by_impression_delete($bms_no, $del_point);

            header("Location: ".ROOT_URL."/admin/finish/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function issuepwdAction()
    {
        try
        {
            $this->checkLogin();
            $bms_info = new BmsInfo();
            $bms_info->change_password($this->request->getPost());

            header("Location: ".ROOT_URL."/admin/finish/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function viewresultAction()
    {
        $this->checkLogin();
        function cmp($a, $b)
        {
            if ($a['point'] == $b['point'])
            {
                return ($a['imp'] < $b['imp']) ? -1 : 1;
            }
            return ($a['point'] > $b['point']) ? -1 : 1;
        }

        try
        {
            $bms_info = new BmsInfo();
            $bms_data = $bms_info->get_data();

            usort($bms_data, 'cmp');
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
        $this->view->assign('bms_data', $bms_data);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('admin/admin_result.tpl');
    }
    
    public function changemasterpassAction()
    {
        try
        {
            $this->checkLogin();
            $master = new Master();
            $master->change_pwd($this->request->getPost('password'));
            header("Location: ". ROOT_URL . "/admin/finish/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function finishAction()
    {
        $this->checkLogin();
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('admin/admin_finish.tpl');
    }

}
