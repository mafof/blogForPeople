<?php
namespace App\Controllers;
require_once "App/models/ModelProfileRemovePost.php";

use App\Core\BaseController;
use App\Models\ModelProfileRemovePost;

class ControllerProfileRemovePost extends BaseController {
    public function action() {
        $this->model = new ModelProfileRemovePost();
        $this->model->get_data();
    }
}