<?php
namespace App\Controllers;
require_once "app/models/model_admin_remove_user.php";

use App\Core\BaseController;
use App\Models\ModelAdminRemoveUser;

class ControllerAdminRemoveUser extends BaseController {
    public function action() {
        $this->model = new ModelAdminRemoveUser();
        $this->model->get_data();
    }
}
