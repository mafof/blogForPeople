<?php
namespace App\Controllers\Profile;

use App\Core\BaseController;
use App\Models\Profile\ModelProfileEditPost;

class ControllerProfileEditPost extends BaseController {
    public function action() {
        $this->model = new ModelProfileEditPost();
        $data = $this->model->get_data();

        $this->view->generate("view_profile_edit_post.php", $data);
    }
}