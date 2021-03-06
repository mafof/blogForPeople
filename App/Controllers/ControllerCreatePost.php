<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelCreatePost;

class ControllerCreatePost extends BaseController {
    public function action() {
        $this->model = new ModelCreatePost();
        $data = $this->model->get_data();
        $this->view->generate("view_create_post.php", $data);
    }
}