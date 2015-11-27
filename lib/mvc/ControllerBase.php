<?php

abstract class ControllerBase
{

    protected $request;
    protected $view;
    protected $current_time;
    protected $ip;
    protected $host;
    
    public function __construct()
    {
        $this->request = new Request();

        date_default_timezone_set('Asia/Tokyo');
        $this->current_time = date('Y/m/d H:i:s');
        $this->ip = getenv("REMOTE_ADDR");
        $this->host = getenv("REMOTE_HOST");
        if ($this->host == "")
        {
            $this->host = $this->ip;
        }
    }

    public function initializeView()
    {
        $this->view = new Smarty();
        $this->view->template_dir = ROOT_PATH . '/views/templates/';
        $this->view->compile_dir = ROOT_PATH . '/views/templates_c/';
    }

    protected function displayErrorView($msg)
    {
        $this->view->assign('msg', $msg);
        $this->view->assign('root_url', ROOT_URL);
        $this->view->display('error.tpl');
        exit();
    }

    protected function tweet($mes)
    {
        require_once("lib/twitteroauth/twitteroauth.php");

        $consumer_key = "zK7Gjax5bz4dwquQlQjpMqrNn";
        $consumer_secret = "D7WRu7OETyDwzrp5hFeWGYOUNOJQSJkyUWGjOBznjXf8pvQi2s";
        $access_token = "228073867-VUbEHWJfbfuRVAZ9iP5x18Xa2Wg8NwBVU4ePxhNA";
        $access_token_secret = "tvwFm63YXaaMBA3OJE7BpS0NyGd3lgVM5zSusiXBaDxJV";

        $to = new TwitterOAuth($consumer_key, $consumer_secret, $access_token, $access_token_secret);

        $req = $to->OAuthRequest("https://api.twitter.com/1.1/statuses/update.json", "POST", array("status" => $mes));
    }

}
