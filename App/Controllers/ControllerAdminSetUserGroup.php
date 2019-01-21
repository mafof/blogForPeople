<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelAdminSetUserGroup;

class ControllerAdminSetUserGroup extends BaseController {
    public function action() {
        $this->model = new ModelAdminSetUserGroup();
        $this->model->get_data();
    }
}