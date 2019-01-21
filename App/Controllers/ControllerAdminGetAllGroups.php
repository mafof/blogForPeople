<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelAdminGetAllGroups;

class ControllerAdminGetAllGroups extends BaseController {
    public function action() {
        $this->model = new ModelAdminGetAllGroups();
        echo json_encode($this->model->get_data(), JSON_UNESCAPED_UNICODE);
    }
}