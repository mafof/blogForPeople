<?php
namespace App\Controllers;

use App\Core\BaseController;

class ControllerLogin extends BaseController {
    public function action() {
        $this->view->generate("view_login.php");
    }
}