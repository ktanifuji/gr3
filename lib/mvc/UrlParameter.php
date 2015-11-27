<?php

class UrlParameter extends RequestVariables
{

    protected function setValues()
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

        // 2番目以降のパラメーターを順に_valuesに格納
        $i = 0;
        if (4 < count($params))
        {
            for ($i = 0; $i < count($params) - 4; $i++)
            {
                $this->_values[$i] = $params[$i + 4];
            }
        }
    }

}
