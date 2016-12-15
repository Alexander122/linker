<?php

namespace core\controllers;

class Controller
{
    /**
     * Running before the action
     */
    public function beforeAction()
    {
        echo "Do something beforeAction<br>";
    }

    /**
     * Running after the action
     */
    public function afterAction()
    {
        echo "Do something afterAction<br>";
    }
    
    /**
     * Render view
     * @param $view
     * @param array $params
     */
    public function render($view, $params = []) {
        extract($params);

        ob_start();
        require_once '../'.$view;
        $renderedView = ob_get_clean();

        echo $renderedView;
    }

    /**
     * Redirect page
     * @param $url
     */
    public function redirect($url)
    {
        header("Location: $url");
    }

    /**
     * Refresh page
     */
    public function refresh()
    {
        $page = $_SERVER['PHP_SELF'];
        $sec = "10";
        header("Refresh: $sec; url=$page");
    }

    /**
     * Render error page
     */
    public function actionError()
    {
        $this->render('views/error.php');
    }
}
