<?php
namespace App\Controllers\Admin;

use App\Core\BaseController;
use App\Models\Admin\ModelAdminRemoveComment;

class ControllerAdminRemoveComment extends BaseController {
    public function action() {
        $this->model = new ModelAdminRemoveComment();
        $this->model->get_data();
    }
}