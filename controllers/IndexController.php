<?php

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        try
        {
            $schedule = new Schedule;
            $is_able_to_register = $schedule->is_in_time('regist', $this->current_time);

            if ($is_able_to_register)
            {
                $this->showIndexPage($schedule);
            }
            else
            {
                $this->showPreIndexPage($schedule);
            }
        }
        catch (Exception $e)
        {
            $this->displayErrorView($e->getMessage());
        }
    }

    private function showIndexPage($schedule)
    {
        $master = new Master();
        $info_message = $master->get_info();

        $is_able_to_register = $schedule->is_in_time('regist', $this->current_time);
        $is_able_to_post_impression = $schedule->is_in_time('impre', $this->current_time);

        $bms_info = new BmsInfo();
        $bms_data = $bms_info->get_data();

        $this->view->assign('info_message', $info_message);
        $this->view->assign('bms_data', $bms_data);
        $this->view->assign('is_able_to_register', $is_able_to_register);
        $this->view->assign('is_able_to_post_impression', $is_able_to_post_impression);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('index.tpl');
    }

    private function showPreIndexPage($schedule)
    {
        $master = new Master();
        $info_message = $master->get_info();

        $is_able_to_entry = $schedule->is_in_time('entry', $this->current_time);
        $is_able_to_post_genre = $schedule->is_in_time('genre', $this->current_time);

        $entry = new Entry();
        $entry_data = $entry->get_data();

        $genre = new Genre();
        $genre_data = $genre->get_data();

        $this->view->assign('info_message', $info_message);
        $this->view->assign('entry_data', $entry_data);
        $this->view->assign('genre_data', $genre_data);
        $this->view->assign('is_able_to_entry', $is_able_to_entry);
        $this->view->assign('is_able_to_post_genre', $is_able_to_post_genre);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('preindex.tpl');
    }

}
