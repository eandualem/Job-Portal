<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/7/18
 * Time: 9:50 PM
 */

class login extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function login()
    {
        $login_model = $this->loadModel('Login');
        $user = $login_model->login();

        if ($user == "employee")
        {
            try {
                require EMPLOYEE_CONTROLLER_PATH . 'employee.php';
                $emp = new employee();
                $emp->index();
            } catch (Exception $e) {
                throw new Exception("Error rendering result");
            }
        }
        if ($user == "employer")
        {
            try {
                require EMPLOYER_CONTROLLER_PATH . 'employer.php';
                $emp = new employer();
                $emp->index();
            } catch (Exception $e) {
                throw new Exception("Error rendering result");
            }
        }
        else {
            echo 'not secces';
            }
    }
    function logout()
    {
        $login_model = $this->loadModel('Login');
        $login_model->logout();
        // redirect user to base URL
        header('location: ' . URL);
    }
}