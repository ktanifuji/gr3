<?php

class ReviseController extends ControllerBase
{

    public function formAction()
    {
        try
        {
            if (($bms_no = $this->request->getParam('0')) == null)
            {
                throw new Exception('不正なリクエストです。');
            }

            $bms_info = new BmsInfo();
            $bms_data = $bms_info->get_data($bms_no);

            $schedule = new Schedule;
            $is_able_to_register = $schedule->is_in_time('regist', $this->current_time);
            $is_able_to_post_impression = $schedule->is_in_time('impre', $this->current_time);
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
        $this->view->assign('bms_no', $bms_no);
        $this->view->assign('bms_data', $bms_data);
        $this->view->assign('current_time', $this->current_time);
        $this->view->assign('is_able_to_register', $is_able_to_register);
        $this->view->assign('is_able_to_post_impression', $is_able_to_post_impression);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('revise.tpl');
    }

    public function reviseAction()
    {
        try
        {
            if (!$this->request->getPost())
            {
                throw new Exception('こらっ');
            }

            if ($this->request->getPost('password') == null)
            {
                throw new Exception('パスワードを入れてください。');
            }

            $bms_info = new BmsInfo();

            $bms_data = $bms_info->get_data($this->request->getPost('bms_no'));
            if (!(crypt($this->request->getPost('password'), $bms_data['password']) === $bms_data['password']))
            {
                throw new Exception('パスワードが一致しません');
            }

            $bms_info->revise($this->request->getPost(), $this->current_time, $this->ip, $this->host);

            header("Location: " . ROOT_URL . "/revise/thanks/");
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function thanksAction()
    {
        try
        {
            $schedule = new Schedule;
            $is_able_to_register = $schedule->is_in_time('regist', $this->current_time);
            $is_able_to_post_impression = $schedule->is_in_time('impre', $this->current_time);
        }
        catch (Exception $ex)
        {
            $this->displayErrorView($e->getMessage());
        }
        $this->view->assign('head', '作品情報修正受付完了');
        $this->view->assign('msg', 'あなたの作品情報を修正しました');
        $this->view->assign('is_able_to_register', $is_able_to_register);
        $this->view->assign('is_able_to_post_impression', $is_able_to_post_impression);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('thanks.tpl');
    }

}
