<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Core\BaseModel;

class ControllerAbout extends BaseController {
    public function action() {
        $this->model = new BaseModel();
        $data = $this->model->getDataUser();
        $this->view->generate("view_about.php", $data);
    }
}