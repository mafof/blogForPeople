<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Core\BaseModel;

class ControllerMain extends BaseController {
    public function action() {
        $this->model = new BaseModel();
        $data = $this->model->getDataUser();
        $this->view->generate("view_main.php", $data);
    }
}