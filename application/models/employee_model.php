<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/14/18
 * Time: 9:15 PM
 */

class EmployeeModel
{
    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function search($sql)
    {
        $statement = $this->db->prepare($sql);
        $statement->execute();

        $array_of_result = array();
        $number_of_results = 0;

        foreach ($statement->fetchAll() as $row)
        {
            $type = $row->JobType;
            $cdate = $row->CreatedDate;
            $desc = $row->Jobdescription;
            $loc = $row->Joblocation;
            $skill = $row->SkillRequired;
            $educ = $row->Educationalqualificationrequired;
            $empid = $row->Employerid;
            $jobid = $row->Jobid;


            $sql2 = "SELECT * FROM employer WHERE Employerid LIKE '" . $empid . "'";
            $statement = $this->db->prepare($sql2);
            $statement->execute();
            $result = $statement->fetch();

            $name = $result->name;
            $country = $result->country;
            $city = $result->city;
            $add = $result->address;
            $email = $result->email;
            $phone = $result->phone;

            $temp=array('name'=>$name,'country'=>$country, 'city'=>$city, 'add'=>$add,
                'email'=>$email, 'phone'=>$phone, 'jobid'=>$jobid, 'educ'=>$educ,
                'skill'=>$skill, 'loc'=>$loc, 'desc'=>$desc, 'cdate'=>$cdate, 'type'=>$type);

            $array_of_result[$number_of_results] = json_encode($temp);
            $number_of_results ++;
        }
        return $array_of_result;
    }

    public function apply()
    {
        $emplid = $_SESSION['userid'];
        $jobid = $_POST['JOBID'];

        $sql = "INSERT INTO empAppliedJobs (employeeid, Jobid) VALUES ('". $emplid."', '".$jobid."')";

        $query = $this->db->prepare($sql);
        $query->execute();

        $count =  $query->rowCount();
        if ($count != 1) {
            return false;
        }
        else {
            return true;
        }
    }


    public function accepted()
    {

        $emplid = $_SESSION['userid'];
        $sql = "SELECT * FROM empAppliedJobs WHERE employeeid LIKE '". $emplid. "' AND accepted LIKE 'yes'";

        $statement = $this->db->prepare($sql);
        $statement->execute();

        $array_of_result = array();
        $number_of_results = 0;

        while ($row = $statement->fetch()) {
            $type = $row->JobType;
            $cdate = $row->CreatedDate;
            $desc = $row->Jobdescription;
            $loc = $row->Joblocation;
            $skill = $row->SkillRequired;
            $educ = $row->Educationalqualificationrequired;
            $empid = $row->Employerid;
            $jobid = $row->Jobid;


            $sql2 = "SELECT * FROM employer WHERE Employerid LIKE '" . $empid . "'";
            $statement = $this->db->prepare($sql2);
            $statement->execute();
            $result = $statement->fetch();

            $name = $result->name;
            $country = $result->country;
            $city = $result->city;
            $add = $result->address;
            $email = $result->email;
            $phone = $result->phone;


            $temp=array('name'=>$name,'country'=>$country, 'city'=>$city, 'add'=>$add,
                'email'=>$email, 'phone'=>$phone, 'jobid'=>$jobid, 'educ'=>$educ,
                'skill'=>$skill, 'loc'=>$loc, 'desc'=>$desc, 'cdate'=>$cdate, 'type'=>$type);

            $array_of_result[$number_of_results] = json_encode($temp);
            $array_of_result ++;
        }
        return $array_of_result;
    }

    public function former()
    {

        $emplid = $_SESSION['userid'];
        $sql = "SELECT * FROM workedtogether WHERE employeeid LIKE '". $emplid. "'";
        $statement = $this->db->prepare($sql);
        $statement->execute();

        $array_of_result = array();
        $number_of_results = 0;

        while ($row = $statement->fetch()){
            $employerid = $row->Employerid;
            $sql2 = "SELECT * FROM employer WHERE employerid LIKE '" . $employerid . "'";

            $statement = $this->db->prepare($sql2);
            $statement->execute();
            $result = $statement->fetch();

            $name = $result->name;
            $country = $result->country;
            $city = $result->city;
            $add = $result->address;
            $email = $result->email;
            $phone = $result->phone;


            $sql3 = "SELECT * FROM Job WHERE Employerid LIKE '". $employerid. "'";
            echo $sql3;

            $statement = $this->db->prepare($sql3);
            $statement->execute();

            while ($row = $statement->fetch()) {
                $type = $row->JobType;
                $cdate = $row->CreatedDate;
                $desc = $row->Jobdescription;
                $loc = $row->Joblocation;
                $skill = $row->SkillRequired;
                $educ = $row->Educationalqualificationrequired;
                $jobid = $row->Jobid;


                $temp=array('name'=>$name,'country'=>$country, 'city'=>$city, 'add'=>$add,
                    'email'=>$email, 'phone'=>$phone, 'jobid'=>$jobid, 'educ'=>$educ,
                    'skill'=>$skill, 'loc'=>$loc, 'desc'=>$desc, 'cdate'=>$cdate, 'type'=>$type);

                $array_of_result[$number_of_results] = json_encode($temp);
                $array_of_result ++;

            }

        }
        return $array_of_result;
    }


}