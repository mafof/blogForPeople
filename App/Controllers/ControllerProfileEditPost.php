<?php
namespace App\Controllers;
require_once "App/models/ModelProfileEditPost.php";

use App\Core\BaseController;
use App\Models\ModelProfileEditPost;

class ControllerProfileEditPost extends BaseController {
    public function action() {
        $this->model = new ModelProfileEditPost();
        $data = $this->model->get_data();

        $this->view->generate("view_profile_edit_post.php", $data);
    }
}