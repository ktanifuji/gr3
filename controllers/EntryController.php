<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of EntryController
 *
 * @author Akihito
 */
class EntryController extends ControllerBase
{

    public function entryAction()
    {
        try
        {
            if (!$this->request->getPost())
            {
                throw new Exception('こらっ');
            }

            $schedule = new Schedule;
            $is_able_to_entry = $schedule->is_in_time('entry', $this->current_time);
            if ($is_able_to_entry)
            {
                // 参加表明データを登録
                $entry = new Entry();
                $entry->add($this->request->getPost(), $this->current_time, $this->ip, $this->host);

                header("Location: " . ROOT_URL . "/entry/thanks/");
            }
            else
            {
                throw new Exception('参加表明期間ではありません');
            }
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    public function thanksAction()
    {
        $this->view->assign('root_url', ROOT_URL);
        $this->view->assign('head', 'Entry is Completed.');
        $this->view->assign('msg', 'あなたの参加表明を受け付けました');
        $this->view->display('thanks.tpl');
    }

}
