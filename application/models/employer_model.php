<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/7/18
 * Time: 7:57 PM
 */

class EmployerModel {

    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }

    public function create_job($new_job)
    {
       $job = json_decode($new_job);

        // write new users data into database
        $sql = "INSERT INTO Job (JobType, Jobdescription, isactive, SkillRequired, Employerid, maxsalary, minsalary, minrate, maxrate, nemberofemployee) VALUES (:JobType, :Jobdescription, :isactive, :SkillRequired, :Employerid, :maxsalary, :minsalary, :minrate, :maxrate, :nemberofemployee)";

        $query = $this->db->prepare($sql);
        $query->execute(array(
            ':JobType'              => $job->JobType,
            ':Jobdescription'       => $job->Jobdescription,
            ':isactive'             => 1,
            ':SkillRequired'        => $job->SkillRequired,
            ':Employerid'           => $_SESSION['userid'],
            ':maxsalary'            => $job->maxsalary,
            ':minsalary'            => $job->minsalary,
            ':minrate'              => $job->minrate,
            ':maxrate'              => $job->maxrate,
            ':nemberofemployee'     => $job->nemberofemployee));

        $count =  $query->rowCount();
        if ($count != 1) {
            return false;
        }
        else {
            return true;
        }
    }

    public function accept()
    {

        $employerid = $_SESSION['userid'];

        $sql = "SELECT * FROM job WHERE employerid LIKE '". $employerid. "'";


        $statement = $this->db->prepare($sql);
        $statement->execute();

        $array_of_result = array();
        $number_of_results = 0;

        while ($row = $statement->fetch()) {

            $jobid = $row->Jobid;


            $sql1 = "SELECT * FROM empAppliedJobs WHERE Jobid LIKE '". $jobid. "' AND accepted LIKE 'yes'";
            $statement = $this->db->prepare($sql1);
            $statement->execute();
            while ($row1 = $statement->fetch()) {
                $employeeid = $row1->employeeid;

                $sql2 = "SELECT * FROM employee WHERE employeeid LIKE '" . $employeeid . "'";
                $statement = $this->db->prepare($sql2);
                $statement->execute();
                while ($row2 = $statement->fetch()) {
                    $name = $row2->name;
                    $country = $row2->country;
                    $city = $row2->city;
                    $add = $row2->address;
                    $email = $row2->email;
                    $phone = $row2->phone;

                    $sql3 = "SELECT * FROM EmployeeEducationalDetail WHERE Employeeid LIKE '" . $employeeid . "'";
                    $statement = $this->db->prepare($sql3);
                    $statement->execute();
                    $row3 = $statement->fetch();

                    $certificate = $row3->CertificateorDegreename;
                    $major = $row3->major;
                    $institute = $row3->InstituteorUniversityname;
                    $stdate = $row3->Startingdate;
                    $codate = $row3->Completiondate;
                    $gpa = $row3->GPA;

                    $temp = array('name' => $name, 'country' => $country, 'city' => $city, 'add' => $add,
                        'email' => $email, 'phone' => $phone, 'jobid' => $jobid, 'certificate' => $certificate,
                        'major' => $major, 'institute' => $institute, 'stdate' => $stdate, 'codate' => $codate, 'gpa' => $gpa);

                    $array_of_result[$number_of_results] = json_encode($temp);
                    $array_of_result++;
                }
            }
        }
        return $array_of_result;
    }

    public function former()
    {
        $employerid = $_SESSION['userid'];
        $sql = "SELECT * FROM workedtogether WHERE employeeid LIKE '". $employerid. "'";

        $statement = $this->db->prepare($sql);
        $statement->execute();

        $array_of_result = array();
        $number_of_results = 0;

        while ($row = $statement->fetch())
        {
            $employeeid = $row->Employerid;
            $sql2 = "SELECT * FROM employee WHERE employerid LIKE '" . $employeeid . "'";

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
                'email'=>$email, 'phone'=>$phone);
            $array_of_result[$number_of_results] = json_encode($temp);
            $array_of_result ++;
        }
        return $array_of_result;
    }

}