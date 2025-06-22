<?php
class Controller {
    public function __construct() {
        $controllerName = get_class($this);
        if ($controllerName !== 'Auth' && !isset($_SESSION['user_id'])) {
            header("Location: index.php?c=Auth&m=login");
            exit();
        }
    }
    function loadView($view = '', $data = []) {
        foreach ($data as $key => $val)
            $$key = $val;
        include 'view/' . $view;
    }

    function loadModel($model = '') {
        require_once "model/$model.class.php";
        return new $model;
    }
}
?>