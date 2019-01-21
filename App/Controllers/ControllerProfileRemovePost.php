<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelProfileRemovePost;

class ControllerProfileRemovePost extends BaseController {
    public function action() {
        $this->model = new ModelProfileRemovePost();
        $this->model->get_data();
    }
}