<?php

class DetailController extends ControllerBase
{

    public function viewAction()
    {
        try
        {
            $bms_no = $this->request->getParam('0');

            if (!file_exists("db/impression$bms_no.sqlite3"))
            {
                throw new Exception('該当データがありません');
            }
            $bms_info = new BmsInfo();
            $bms_data = $bms_info->get_data($bms_no);

            $impression = new Impression($bms_no);
            $impression_data = $impression->get_data();

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
        $this->view->assign('impression_data', $impression_data);
        $this->view->assign('is_able_to_register', $is_able_to_register);
        $this->view->assign('is_able_to_post_impression', $is_able_to_post_impression);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('detail.tpl');
    }

    public function postAction()
    {
        try
        {
            if (!$this->request->getPost())
            {
                throw new Exception('こらっ');
            }

            $schedule = new Schedule;
            $is_able_to_post_impression = $schedule->is_in_time('impre', $this->current_time);

            if ($is_able_to_post_impression)
            {
                $bms_no = $this->request->getPost('bms_no');

                $impression = new Impression($bms_no);
                $impression->post($this->request->getPost(), $this->current_time, $this->ip, $this->host);

                $bms_info = new BmsInfo();
                $bms_info->update_by_impression($bms_no, $this->request->getPost('point'), $this->current_time);

                header("Location: " . ROOT_URL . "/detail/thanks/$bms_no/");
            }
            else
            {
                throw new Exception('作品評価期間ではありません');
            }
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
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
        
        $bms_no = $this->request->getParam('0');
        
        $this->view->assign('head', 'Impression is Completed');
        $this->view->assign('msg', "あなたのインプレッションを受け付けました。<br><a href=\"" . ROOT_URL . "/detail/view/${bms_no}/\">作品詳細に戻る</a>");
        $this->view->assign('is_able_to_register', $is_able_to_register);
        $this->view->assign('is_able_to_post_impression', $is_able_to_post_impression);
        $this->view->assign('root_url', ROOT_URL);
        
        $this->view->display('thanks.tpl');
    }

}
