<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelAdminRemoveUser;

class ControllerAdminRemoveUser extends BaseController {
    public function action() {
        $this->model = new ModelAdminRemoveUser();
        $this->model->get_data();
    }
}
