<?php

class Dispatcher
{

    private $sysRoot;

    public function setSystemRoot($path)
    {
        $this->sysRoot = rtrim($path, '/');
    }

    public function dispatch()
    {
        // パラメーター取得（末尾の / は削除）
        $param = ereg_replace('/?$', '', $_SERVER['REQUEST_URI']);
        $param = ereg_replace('^/', '', $param);

        $params = array();
        if ('' != $param)
        {
            // パラメーターを / で分割
            $params = explode('/', $param);
        }

        // １番目のパラメーターをコントローラーとして取得
        $controller = 'index';
        if (1 < count($params))
        {
            $controller = $params[1];
        }
        $controllerInstance = $this->getControllerInstance($controller);
        if (null == $controller)
        {
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        // 2番目のパラメーターをアクションとして取得
        $action = 'index';
        if (2 < count($params))
        {
            $action = $params[2];
        }
        
        // アクションメソッドの存在確認
        if (false == method_exists($controllerInstance, $action . 'Action'))
        {
            header("HTTP/1.0 404 Not Found");
            exit;
        }

        $controllerInstance->initializeView();

        // アクションメソッドを実行
        $actionMethod = $action . 'Action';
        $controllerInstance->$actionMethod();
    }

    private function getControllerInstance($controller)
    {
        // パラメータより取得したコントローラー名によりクラス振分け
        $className = ucfirst(strtolower($controller)) . 'Controller';

        // クラスファイル読込
        $controllerFileName = $this->sysRoot . '/controllers/' . $className . '.php';

        if (false == file_exists($controllerFileName))
        {
            return null;
        }

        require_once $controllerFileName;

        if (false == class_exists($className))
        {
            return null;
        }

        // クラスインスタンス生成
        $controllerInstance = new $className();

        return $controllerInstance;
    }
}
