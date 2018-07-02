<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/14/18
 * Time: 6:40 PM
 */

class register_employee extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    function register(){
        if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
        {
            $UserName = $_POST['UserName'];
            $Password = $_POST['Password'];
            $Email = $_POST['email'];
            $DateOfBirth = $_POST['DateOfBirth'];
            $Sex = $_POST['Sex'];
            if ($Sex == 'female'){
                $Sex = "F";
            }
            else{
                $Sex = "M";
            }
            $Phone = $_POST['Phone'];
            $Postal = $_POST['Postal'];
            $Country = $_POST['Country'];
            $Region = $_POST['Region'];
            $City = $_POST['City'];
            $Address = $_POST['Address'];
            $AboutMe = $_POST['AboutMe'];

            $temp=array('name'=>$UserName,'pass'=>$Password, 'email'=>$Email, 'date'=>$DateOfBirth, 'sex'=>$Sex,
                'phone'=>$Phone, 'postal'=>$Postal, 'country'=>$Country, 'region'=>$Region, 'city'=>$City, 'add'=>$Address, 'about'=>$AboutMe);

            $login_model = $this->loadModel('Login');
            $user = $login_model->create_employee(json_encode($temp));

            if($user)
            {
                try {
                    $this->view->render_login_page('login');
                } catch (Exception $e) {
                    throw new Exception("Error rendering result");
                }
            } else {
                $this->view->render_login_page('employee_registration');
            }

        }

        else {
            $this->view->render_login_page('employee_registration');
        }
    }

}