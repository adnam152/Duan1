<?php

namespace MVC;

class Controller {
    protected function render($data = []) {
        extract($data);
        require "Views/base.php";
    }
}
    