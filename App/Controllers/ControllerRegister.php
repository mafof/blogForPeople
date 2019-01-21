<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelRegister;

class ControllerRegister extends BaseController {
    public function action() {
        $this->model = new ModelRegister();
        $data = $this->model->get_data();
        $this->view->generate("view_register.php", $data);
    }
}