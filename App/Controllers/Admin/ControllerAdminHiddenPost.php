<?php
namespace App\Controllers\Admin;

use App\Core\BaseController;
use App\Models\Admin\ModelAdminHiddenPost;

class ControllerAdminHiddenPost extends BaseController {
    public function action() {
        $this->model = new ModelAdminHiddenPost();
        $this->model->get_data();
    }
}