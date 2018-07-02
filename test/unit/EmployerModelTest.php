<?php
/**
 * Created by PhpStorm.
 * User: Ideapad
 * Date: 7/2/2018
 * Time: 4:26 AM
 */


//use EmployerModel;
use PHPUnit\Framework\TestCase;
require '../assets/FakeJob.php';
require '../assets/FakeEmployee.php';
require '../assets/FakeEmployer.php';
require '../assets/FakeEmpAppliedJob.php';
require '../assets/FakeEmployeeEducationalDetail.php';

class EmployerModelTest extends TestCase
{
    public static $db;

    protected function setUp()
    {
        self::$db = $this->getMockBuilder("PDO")
            ->setConstructorArgs(['sqlite:memory'])
            ->getMock();

    }

    public function testAccept()
    {

        $_SESSION['userid'] = 1;

        $fakeJob = array(
            'JobType' => 'Permanent',
            'CreatedDate' => '20-08-2017',
            'Jobdescription' => 'General manager of Anbessa bus',
            'Joblocation' => 'Gerji mebrat hail infront of totot cultural food house',
            'SkillRequired' => 'people friendly, optimistic',
            'Educationalqualificationrequired' => 'Masters in managment',
            'Employerid' => 1,
            'Jobid' => 1
        );

        $job = new FakeJob();
        foreach ($fakeJob as $field => $value) {
            $job->{$field} = $value;
        }

        $fakeappl = array(
            'Employeeid' => 1,
            'Employerid' => 1,
            'Jobid' => 1
        );

        $applied = new FakeEmpAppliedJob();
        foreach ($fakeappl as $field => $value) {
            $applied->{$field} = $value;
        }

        $fakeEmployee = array(
            'id' => 1,
            'name' => 'Elias',
            'password' => 'Satellite',
            'email' => 'eandualem@gmail.com',
            'age' => 22,
            'sex' => 'M',
            'phone' => 911099351,
            'postal' => 88898,
            'country' => 'Ethiopia',
            'region' => 'region',
            'city' => 'AA',
            'address' => 'Arat Killo',
            'about' => 'I\'m Great',
            'active' => 1
        );
        $employee = new FakeEmployee();
        foreach ($fakeEmployee as $field => $value) {
            $employee->{$field} = $value;
        }

        $fakeEducdetail = array(
            'CertificateorDegreename' => 'BSC',
            'major' => 'Management',
            'InstituteorUniversityname' => 'AAU',
            'Startingdate' => '20-04-2014',
            'Completiondate' => '10-02-2018',
            'GPA' => '3.0');

        $educDetail = new FakeEmployeeEducationalDetail();
        foreach ($fakeEducdetail as $field => $value) {
            $educDetail->{$field} = $value;
        }

        $sth = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute','fetch'))
            ->getMock();
        $sth->method('execute')
            ->will($this->returnValue(true));
        $sth->expects($this->at(0))
            ->method('fetch')
            ->will($this->returnValue($job));
        $sth->expects($this->at(1))
            ->method('fetch')
            ->will($this->returnValue(0));

        $sth2 = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'fetch'))
            ->getMock();
        $sth2->method('execute')
            ->will($this->returnValue(true));
        $sth2->method('fetch')
            ->will($this->returnValue($applied));
        $sth2->expects($this->at(1))
            ->method('fetch')
            ->will($this->returnValue(0));

        $sth3 = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute','fetch'))
            ->getMock();
        $sth3->method('execute')
            ->will($this->returnValue(true));
        $sth3->expects($this->at(0))
            ->method('fetch')
            ->will($this->returnValue($employee));
        $sth3->expects($this->at(1))
            ->method('fetch')
            ->will($this->returnValue(0));

        $sth4 = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'fetch'))
            ->getMock();
        $sth4->method('execute')
            ->will($this->returnValue(true));
        $sth4->method('fetch')
            ->will($this->returnValue($educDetail));

        self::$db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM job WHERE employerid LIKE '1'"))
            ->will($this->returnValue($sth));
        self::$db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM empAppliedJobs WHERE Jobid LIKE '1' AND accepted LIKE 'yes'"))
            ->will($this->returnValue($sth2));
        self::$db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM employee WHERE employeeid LIKE '1'"))
            ->will($this->returnValue($sth3));
        self::$db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM EmployeeEducationalDetail WHERE Employeeid LIKE '1'"))
            ->will($this->returnValue($sth4));

        $temp=array(
            'name' => 'Elias',
            'email' => 'eandualem@gmail.com',
            'phone' => 911099351,
            'country' => 'Ethiopia',
            'city' => 'AA',
            'add' => 'Arat Killo',
            'jobid' => 1,
            'codate' => '10-02-2018',
            'certificate' => 'BSC',
            'major' => 'management',
            'institute' => 'AAU',
            'stdate' => '20-04-2014',
            'gpa' => 3.0);


        $temp = json_encode($temp);
        $exp = array();

        $exp[0] = $temp;
        $Employer = new EmployerModel(self::$db);

        $this->assertEquals(
            $exp,
            $Employer->accept(),
            " "
        );

    }

    public function testCreate_job()
    {
        $_SESSION['userid'] = 1;
        $temp=array(
            'JobName'=>'programmer',
            'JobType'=>'permanent',
            'Jobdescription'=>'back end web developer',
            'SkillRequired'=>'php, node js',
            'maxsalary'=>8,000,
            'minsalary'=>6,000,
            'minrate'=>40,
            'maxrate'=>60,
            'nemberofemployee'=>2);

        $sth = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute','rowCount'))
            ->getMock();
        $sth->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(1));
        $sth->expects($this->once())
            ->method('execute')
            ->with($this->contains(array(
            ':JobType'              => 'permanent',
            ':Jobdescription'       => 'back end web developer',
            ':isactive'             => 1,
            ':SkillRequired'        => 'php, node js',
            ':Employerid'           => 1,
            ':maxsalary'            => 8,000,
            ':minsalary'            => 6,000,
            ':minrate'              => 40,
            ':maxrate'              => 60,
            ':nemberofemployee'     => 2)))
            ->will($this->returnValue(true));

        self::$db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains("insert into job (jobtype, jobdescription, isactive, skillrequired, employerid, maxsalary, minsalary, minrate, maxrate, nemberofemployee) values (:jobtype, :jobdescription, :isactive, :skillrequired, :employerid, :maxsalary, :minsalary, :minrate, :maxrate, :nemberofemployee)"))
            ->will($this->returnValue($sth));

        $Employer = new EmployerModel(self::$db);

        $this->assertEquals(
            true,
            $Employer->create_job(json_encode($temp)),
            " "
        );
    }


    public function testFormer()
    {

        $_SESSION['userid'] = 1;

        $fakeFormer = new FakeFormer();
        $fakeFormer->Employeeid = 1;
        $fakeFormer->Employerid = 1;

        $fakeEmployee = array(
            'id' => 1,
            'name' => 'Elias',
            'password' => 'Satellite',
            'email' => 'eandualem@gmail.com',
            'age' => 22,
            'sex' => 'M',
            'phone' => 911099351,
            'postal' => 88898,
            'country' => 'Ethiopia',
            'region' => 'region',
            'city' => 'AA',
            'address' => 'Arat Killo',
            'about' => 'I\'m Great',
            'active' => 1
        );
        $employee = new FakeEmployee();
        foreach ($fakeEmployee as $field => $value) {
            $employee->{$field} = $value;
        }

        $sth = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute','fetch'))
            ->getMock();
        $sth->method('execute')
            ->will($this->returnValue(true));
        $sth->expects($this->at(0))
            ->method('fetch')
            ->will($this->returnValue($fakeFormer));
        $sth->expects($this->at(1))
            ->method('fetch')
            ->will($this->returnValue(0));

        $sth2 = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'fetch'))
            ->getMock();
        $sth2->method('execute')
            ->will($this->returnValue(true));
        $sth2->method('fetch')
            ->will($this->returnValue($employee));



        self::$db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM workedtogether WHERE employeeid LIKE '1'"))
            ->will($this->returnValue($sth));
        self::$db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM employee WHERE employerid LIKE '1'"))
            ->will($this->returnValue($sth2));

        $temp=array(
            'name' => 'Elias',
            'email' => 'eandualem@gmail.com',
            'phone' => 911099351,
            'country' => 'Ethiopia',
            'city' => 'AA',
            'add' => 'Arat Killo',);


        $temp = json_encode($temp);
        $exp = array();

        $exp[0] = $temp;
        $Employee = new EmployerModel(self::$db);

        $this->assertEquals(
            $exp,
            $Employee->former(),
            " "
        );
    }
}
