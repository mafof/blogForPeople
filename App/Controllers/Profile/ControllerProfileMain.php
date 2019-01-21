<?php
namespace App\Controllers\Profile;

use App\Core\BaseController;
use App\Models\Profile\ModelProfileMain;

class ControllerProfileMain extends BaseController {
    public function action() {
        $this->model = new ModelProfileMain();
        $data = $this->model->get_data();

        $this->view->generate("view_profile_main.php", $data);
    }

}