<?php

namespace core\controllers;

// TODO реализовать поведение (при помощи паттерна Наблюдатель)
class Controller
{
    /**
     * Running before the action
     */
    public function beforeAction()
    {
        // Do something
    }

    /**
     * Running after the action
     */
    public function afterAction()
    {
        // Do something
    }
    
    public function __construct($pieces)
    {
        $this->module = $pieces['module'];
        $this->controller = $pieces['controller'];
        $this->action = $pieces['action'];
    }
    
    /**
     * Render view
     * @param $view
     * @param array $params
     */
    public function render($view, $params = []) {
        extract($params);

        ob_start();
        require_once "../view/{$this->controller}/$view.php";
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
