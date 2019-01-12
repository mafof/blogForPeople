<?php
namespace App\Controllers;
require_once "app/models/model_admin_set_user_group.php";

use App\Core\BaseController;
use App\Models\ModelAdminSetUserGroup;

class ControllerAdminSetUserGroup extends BaseController {
    public function action() {
        $this->model = new ModelAdminSetUserGroup();
        $this->model->get_data();
    }
}