<?php
/**
 * Created by PhpStorm.
 * User: jobportal
 * Date: 7/1/18
 * Time: 10:27 AM
 */

use PHPUnit\Framework\TestCase;

class addVacanciesTest extends TestCase
{
    public static $db;
    protected function setUp()
    {
        self::$db = $this->getMockBuilder("PDO")
            ->setConstructorArgs(['sqlite:memory'])
            ->getMock();
    }

    public function testAdd()
    {
        $_POST['JobName'] = "Web Developer";
        $_POST['SkillReq'] = "Programmer";
        $_POST['MinRate'] = "100";
        $_POST['MinSalary'] = '300';
        $_POST['Job_type_entered'] = 'Part Time';
        $_POST['NoEmp'] = 5;
        $_POST['MaxRate'] = 300;
        $_POST['MaxSalary'] = 9000;
        $_POST['Description'] = "We need great programmers";

        $employer_model = $this->getMockBuilder('EmployerModel')
            ->setMethods(array('__construct', 'create_job'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $employer_model->expects($this->once())
            ->method('create_job')
            ->with($this->stringContains('{"JobName":"Web Developer","JobType":"Part Time","Jobdescription":"We need great programmers","SkillRequired":"Programmer","maxsalary":9000,"minsalary":"300","minrate":"100","maxrate":300,"nemberofemployee":5}'))
            ->will($this->returnValue(true));

        $addVacancies = $this->getMockBuilder('addVacancies')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["add"])
            ->getMock();

        $addVacancies->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('Employer'))
            ->will($this->returnValue($employer_model));

        $addVacancies->add();
        $this->expectException("Error rendering result");
    }
}
