<?php
namespace App\Controllers;

use App\Core\BaseController;

class ControllerMain extends BaseController {
    public function action() {
        $this->view->generate("view_main.php");
    }
}