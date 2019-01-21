<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelShowPost;

class ControllerShowPost extends BaseController {
    public function action() {
        $this->model = new ModelShowPost();
        $data = $this->model->get_data();

        $this->view->generate("view_show_post.php", $data);
    }
}