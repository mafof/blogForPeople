<?php
namespace App\Controllers;
require_once "App/models/ModelAdminHiddenPost.php";

use App\Core\BaseController;
use App\Models\ModelAdminHiddenPost;

class ControllerAdminHiddenPost extends BaseController {
    public function action() {
        $this->model = new ModelAdminHiddenPost();
        $this->model->get_data();
    }
}