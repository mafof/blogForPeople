<?php
namespace App\Controllers;

use App\Core\BaseController;

class ControllerRegister extends BaseController {
    public function action() {
        $this->view->generate("view_register.php", null, null);
    }
}