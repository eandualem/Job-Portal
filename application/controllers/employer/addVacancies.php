<?php
/**
 * Created by PhpStorm.
 * User: eandualem
 * Date: 6/20/18
 * Time: 3:36 AM
 */

class addVacancies extends Controller
{
    function __construct()
    {
        parent::__construct();
    }

    public function add()
    {
        $JobName = $_POST["JobName"];
        $SkillReq = $_POST["SkillReq"];
        $MinRate = $_POST["MinRate"];
        $MinSalary = $_POST["MinSalary"];
        $Job_type = $_POST["Job_type_entered"];
        $NoEmp = $_POST["NoEmp"];
        $MaxRate = $_POST["MaxRate"];
        $MaxSalary = $_POST["MaxSalary"];
        $Description = $_POST["Description"];


        $temp=array('JobName'=>$JobName,'JobType'=>$Job_type,'Jobdescription'=>$Description, 'SkillRequired'=>$SkillReq, 'maxsalary'=>$MaxSalary, 'minsalary'=>$MinSalary,
            'minrate'=>$MinRate, 'maxrate'=>$MaxRate, 'nemberofemployee'=>$NoEmp);

        $login_model = $this->loadModel('Employer');
        $inserted = $login_model->create_job(json_encode($temp));


        if($inserted)
        {
            try {
                echo "Job Added Successfully";
            } catch (Exception $e) {
                throw new Exception("Error rendering result");
            }
        } else {
            echo "Failed try again";
        }

    }

}