<?php

class Home extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->render_login_page('login');
    }

    public function forgot()
    {
        require './application/views/_templates/header.php';
        require './application/views/login/forgot.php';
        require './application/views/_templates/footer.php';
    }
}
