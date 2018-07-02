<?php

function autoload($class) {
    if (file_exists(LIBS_PATH . $class . ".php")) {
        require LIBS_PATH . $class . ".php";
    } else {
        require "../../vendor/autoload.php";
    }
}

spl_autoload_register("autoload");
