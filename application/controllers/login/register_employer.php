<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/14/18
 * Time: 6:39 PM
 */

class register_employer extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function register(){
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {
            $UserName = $_POST['UserName'];
            $Password = $_POST['Password'];
            $Email = $_POST['email'];
            $Country = $_POST['Country'];
            $Region = $_POST['Region'];
            $City = $_POST['City'];
            $Address = $_POST['Address'];
            $Phone = $_POST['Phone'];

            $temp=array('name'=>$UserName,'pass'=>$Password, 'email'=>$Email,
                'country'=>$Country, 'region'=>$Region, 'city'=>$City, 'add'=>$Address, 'phone'=>$Phone);

            $login_model = $this->loadModel('Login');
            $user = $login_model->create_employer(json_encode($temp));

            if($user)
            {
                try {
                    $this->view->render_login_page('login');
                } catch (Exception $e) {
                    throw new Exception("Error rendering result");
                }
            } else {
                $this->view->render_login_page('employer_registration');
            }
        }
        else{
            $this->view->render_login_page('employer_registration');
        }
    }

}