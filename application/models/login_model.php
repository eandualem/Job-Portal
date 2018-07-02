<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/7/18
 * Time: 7:57 PM
 */

class LoginModel
{

    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    public function __construct($db)
    {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function login(){
        $UserType = $_POST['UserType'];
        $email = $_POST['Email'];
        $password = $_POST['password'];

        if ($UserType == "employee") {
            if ($this->login_employee($email, $password)){
                return $UserType;
            }
            else{
                return "false";
            }
        }
        else{
            if ($this->login_employer($email, $password)){
                return $UserType;
            }
            else{
                return "false";
            }
        }
    }

    public function login_employee($email, $password)
    {
        $sql = "SELECT * FROM employee WHERE email LIKE :inserted_email ";
        $statement = $this->db->prepare($sql);
        $statement->execute(array(':inserted_email' => $email));

        $count = $statement->rowCount();
        if ($count != 1) {
            $_SESSION["message"] = "FEEDBACK_LOGIN_FAILED";
            return false;
        }
        $result = $statement->fetch();
        if ($password == $result->password) {
            Session::init();
            Session::set('user_logged_in', true);
            Session::set('userid', $result->employeeid);
            return true;
        }
        else {
            $_SESSION["message"] = "FEEDBACK_PASSWORD_WRONG";
            return false;
        }
    }
    public function login_employer($email, $password)
    {
        $sql = "SELECT * FROM employer WHERE email LIKE :inserted_email ";
        $statement = $this->db->prepare($sql);
        $statement->execute(array(':inserted_email' => $email));
        $count = $statement->rowCount();
        if ($count != 1) {
            $_SESSION["message"] = "FEEDBACK_LOGIN_FAILED";
            return false;
        }
        $result = $statement->fetch();
        if ($password == $result->password) {

            Session::init();
            Session::set('user_logged_in', true);
            Session::set('userid', $result->employerid);

            return true;
        }
        else {
            // feedback message
            $_SESSION["message"] = "FEEDBACK_PASSWORD_WRONG";
            return false;
        }
    }

    public function logout()
    {
        setcookie('rememberme', false, time() - (3600 * 3650), '/', COOKIE_DOMAIN);

        // delete the session
        Session::destroy();
    }


    public function create_employer($user)
    {
        $new_user = json_decode($user);

        // check if username already exists
        $sql = "SELECT * FROM employer WHERE email LIKE :inserted_email ";
        $statement = $this->db->prepare($sql);
        $statement->execute(array(':inserted_email' => $new_user->email));
        $count = $statement->rowCount();
        if ($count == 1) {
            $_SESSION["message"] = "Acount Already Exists";
            return false;
        }

        // write new users data into database
        $sql = "INSERT INTO employer (name, password, email, country, region, city, address, phone, active)
                          VALUES (:name, :password, :email, :country, :region, :city, :address, :phone, :active)";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':name'      => $new_user->name,
            ':password' => $new_user->pass,
            ':email'    => $new_user->email,
            ':country'  => $new_user->country,
            ':region'   => $new_user->region,
            ':city'     => $new_user->city,
            ':address'  => $new_user->add,
            ':phone'    => $new_user->phone,
            ':active'   => 0));

            $count =  $query->rowCount();
            if ($count != 1) {
                $_SESSION["message"] = "FAiled To create acount";
                return false;
            }
            else {
                $_SESSION["message"] = "Account Created Succesfully";
                return true;
            }
    }

    public function create_employee($user)
    {
        $new_user = json_decode($user);

        // check if username already exists
        $sql = "SELECT * FROM employee WHERE email LIKE :inserted_email ";
        $statement = $this->db->prepare($sql);
        $statement->execute(array(':inserted_email' => $new_user->email));
        $count = $statement->rowCount();
        if ($count == 1) {
            $_SESSION["message"] = "Account Already Exists";
            return false;
        }

        // write new users data into database
        $sql = "INSERT INTO employee (name, password, email, age, sex, phone, postal, country, region, city, address, about, active)
                            VALUES (:name, :password, :email, :age, :sex, :phone, :postal, :country, :region, :city, :address, :about, :active)";
        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':name'      => $new_user->name,
            ':password' => $new_user->pass,
            ':email'    => $new_user->email,
            ':age'  => $new_user->country,
            ':sex'   => $new_user->region,
            ':phone'     => $new_user->city,
            ':postal'  => $new_user->add,
            ':country'  => $new_user->country,
            ':region'   => $new_user->region,
            ':city'     => $new_user->city,
            ':address'  => $new_user->add,
            ':about'    => $new_user->about,
            ':active'   => 0));

        $count =  $query->rowCount();
        if ($count != 1) {
            $_SESSION["message"] = "FAiled To create acount";
            return false;
        }
        else {
            $_SESSION["message"] = "Account Created Succesfully";
            return true;
        }
    }
}




