<?php
namespace App\Controllers;
require_once "App/models/ModelConfirmAccount.php";

use App\Core\BaseController;
use App\Models\ModelConfrimAccount;

class ControllerConfirmAccount extends BaseController {
    public function action() {
        $this->model = new ModelConfrimAccount();
        $data = $this->model->get_data();
        $this->view->generate("view_confirm_account.php", $data, null);
    }
}