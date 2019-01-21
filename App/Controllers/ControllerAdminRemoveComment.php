<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelAdminRemoveComment;

class ControllerAdminRemoveComment extends BaseController {
    public function action() {
        $this->model = new ModelAdminRemoveComment();
        $this->model->get_data();
    }
}