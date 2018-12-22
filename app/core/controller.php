<?php
namespace App\Core;

class BaseController {
    public $model;
    public $view;

    function __construct() {
        $this->view = new BaseView();
    }

    function action() {}
}
?>