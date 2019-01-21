<?php
namespace App\Core;

class BaseView {
    public function generate($content_view, $data = null, $template_view = "view_template_main.php") {
        if($template_view != null)
            include 'App/Views/' . $template_view;
        else
            include 'App/Views/' . $content_view;
    }
}

?>