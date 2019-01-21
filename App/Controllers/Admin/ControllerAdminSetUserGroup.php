<?php
namespace App\Controllers\Admin;

use App\Core\BaseController;
use App\Models\Admin\ModelAdminSetUserGroup;

class ControllerAdminSetUserGroup extends BaseController {
    public function action() {
        $this->model = new ModelAdminSetUserGroup();
        $this->model->get_data();
    }
}