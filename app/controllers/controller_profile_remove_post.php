<?php
namespace App\Controllers;
require_once "app/models/model_profile_remove_post.php";

use App\Core\BaseController;
use App\Models\ModelProfileRemovePost;

class ControllerProfileRemovePost extends BaseController {
    public function action() {
        $this->model = new ModelProfileRemovePost();
        $this->model->get_data();
    }
}