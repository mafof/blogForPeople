<?php
namespace App\Controllers;
require_once "app/models/model_login.php";

use App\Core\BaseController;
use App\Models\ModelLogin;

class ControllerLogin extends BaseController {
    public function action() {
        $this->model = new ModelLogin();
        $data = $this->model->get_data();
        $this->view->generate("view_login.php", $data);
    }
}