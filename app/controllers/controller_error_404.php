<?php
namespace App\Controllers;

use App\Core\BaseController;

class ControllerError404 extends BaseController {
    public function action() {
        $this->view->generate("view_error_404.php", null, null);
    }
}