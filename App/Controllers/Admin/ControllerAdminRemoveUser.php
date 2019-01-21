<?php
namespace App\Controllers\Admin;

use App\Core\BaseController;
use App\Models\Admin\ModelAdminRemoveUser;

class ControllerAdminRemoveUser extends BaseController {
    public function action() {
        $this->model = new ModelAdminRemoveUser();
        $this->model->get_data();
    }
}
