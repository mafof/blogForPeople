<?php
namespace App\Controllers;

use App\Core\BaseController;

class ControllerAbout extends BaseController {
    public function action() {
        $this->view->generate("view_about.php");
    }
}