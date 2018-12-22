<?php
namespace App\Core;

class BaseView {
    public function generate($content_view, $data = null, $template_view = "view_template_main.php") {
        if($template_view != null)
            include 'app/views/' . $template_view;
        else
            include 'app/views/' . $content_view;
    }
}

?>