<?php
namespace App\Controllers;
require_once "App/models/ModelAdminMain.php";

use App\Core\BaseController;
use App\Models\ModelAdminMain;

class ControllerAdminMain extends BaseController {
    public function action() {
        $this->model = new ModelAdminMain();
        $data = $this->model->get_data();

        $this->view->generate("view_admin_main.php", $data);
    }
}