<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/9/18
 * Time: 3:32 AM
 */

class register extends Controller
{
    function __construct()
    {
        parent::__construct();
    }


    function register()
    {
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {
            $UserType = $_POST['UserType'];

            if ($UserType == "employee")
            {
                $this->view->render_login_page('employee_registration');
                return true;
            }
            else{
                $this->view->render_login_page('employer_registration');
                return true;
            }
        }
        else{
            $this->view->render_login_page('registration');
            return false;

        }
    }
}