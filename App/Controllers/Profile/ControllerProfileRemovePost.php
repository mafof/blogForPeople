<?php
namespace App\Controllers\Profile;

use App\Core\BaseController;
use App\Models\Profile\ModelProfileRemovePost;

class ControllerProfileRemovePost extends BaseController {
    public function action() {
        $this->model = new ModelProfileRemovePost();
        $this->model->get_data();
    }
}