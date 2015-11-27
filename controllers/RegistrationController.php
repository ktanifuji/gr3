<?php

class RegistrationController extends ControllerBase
{

    public function indexAction()
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

        $this->view->assign('is_able_to_register', $is_able_to_register);
        $this->view->assign('is_able_to_post_impression', $is_able_to_post_impression);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('registration.tpl');
    }

    public function registerAction()
    {
        try
        {
            if (!$this->request->getPost())
            {
                throw new Exception('こらっ');
            }

            $schedule = new Schedule;
            $is_able_to_register = $schedule->is_in_time('regist', $this->current_time);
            if ($is_able_to_register)
            {
                // BMSデータを登録
                $bms_info = new BmsInfo();
                $bms_info->register($this->request->getPost(), $this->current_time, $this->ip, $this->host);

                // インプレッション用のDBを新規作成
                $lastid = $bms_info->get_last_id();

                $impression = new Impression($lastid);
                $impression->create();
                
                header("Location: " . ROOT_URL . "/registration/thanks/");
            }
            else
            {
                throw new Exception('作品登録期間ではありません');
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

        $this->view->assign('is_able_to_register', $is_able_to_register);
        $this->view->assign('is_able_to_post_impression', $is_able_to_post_impression);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->assign('head', 'Registration is Completed.');
        $this->view->assign('msg', 'あなたの作品登録を受け付けました');
        $this->view->display('thanks.tpl');
    }
}
