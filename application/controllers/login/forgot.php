<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/9/18
 * Time: 4:53 AM
 */

class forgot extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function forgot(){

        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $_SESSION['message'] = "Entered";
            $UserType = $_POST['email'];
        }
        else{
            echo "Welcome";
            try {
                $this->view->render_login_page('forgot');
            } catch (Exception $e) {
                throw new Exception("Error rendering result");
            }
        }
    }


}