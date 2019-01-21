<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelAdminHiddenPost;

class ControllerAdminHiddenPost extends BaseController {
    public function action() {
        $this->model = new ModelAdminHiddenPost();
        $this->model->get_data();
    }
}