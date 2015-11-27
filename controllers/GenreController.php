<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GenreController
 *
 * @author Akihito
 */
class GenreController extends ControllerBase
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
            $is_able_to_post_genre = $schedule->is_in_time('genre', $this->current_time);
            if ($is_able_to_post_genre)
            {
                // ジャンルデータを登録
                $genre = new Genre();
                $genre->add($this->request->getPost(), $this->current_time, $this->ip, $this->host);

                header("Location: " . ROOT_URL . "/genre/thanks/");
            }
            else
            {
                throw new Exception('ジャンル応募期間ではありません');
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
        $this->view->assign('head', 'Post is Completed.');
        $this->view->assign('msg', 'あなたのジャンル応募を受け付けました');
        $this->view->display('thanks.tpl');
    }
}
