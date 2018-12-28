<?php
namespace App\Controllers;
require_once "app/models/model_main.php";

use App\Core\BaseController;
use App\Models\ModelMain;

class ControllerMain extends BaseController {
    public function action() {
        $this->model = new ModelMain();
        $data = $this->model->get_data();
        $this->view->generate("view_main.php", $data);
    }
}