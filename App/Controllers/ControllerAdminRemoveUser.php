<?php
namespace App\Controllers;
require_once "App/models/ModelAdminRemoveUser.php";

use App\Core\BaseController;
use App\Models\ModelAdminRemoveUser;

class ControllerAdminRemoveUser extends BaseController {
    public function action() {
        $this->model = new ModelAdminRemoveUser();
        $this->model->get_data();
    }
}
