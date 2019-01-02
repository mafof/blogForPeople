<?php
namespace App\Controllers;
require_once "app/models/model_show_post_category.php";

use App\Core\BaseController;
use App\Models\ModelShowPostToCategory;

class ControllerShowPostToCategory extends BaseController {
    public function action() {
        $this->model = new ModelShowPostToCategory();
        $data = $this->model->get_data();

        $this->view->generate("view_show_post_category.php", $data);
    }
}