<?php
namespace App\Controllers;

use App\Core\BaseController;
use App\Models\ModelConfirmAccount;

class ControllerConfirmAccount extends BaseController {
    public function action() {
        $this->model = new ModelConfirmAccount();
        $data = $this->model->get_data();
        $this->view->generate("view_confirm_account.php", $data, null);
    }
}