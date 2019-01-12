<?php
namespace App\Controllers;
require_once "app/models/model_admin_hidden_post.php";

use App\Core\BaseController;
use App\Models\ModelAdminHiddenPost;

class ControllerAdminHiddenPost extends BaseController {
    public function action() {
        $this->model = new ModelAdminHiddenPost();
        $this->model->get_data();
    }
}