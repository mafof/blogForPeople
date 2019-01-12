<?php
namespace App\Controllers;
require_once "app/models/model_admin_remove_comment.php";

use App\Core\BaseController;
use App\Models\ModelAdminRemoveComment;

class ControllerAdminRemoveComment extends BaseController {
    public function action() {
        $this->model = new ModelAdminRemoveComment();
        $this->model->get_data();
    }
}