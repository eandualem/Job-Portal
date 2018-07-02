<?php
/**
 * Created by PhpStorm.
 * User: Ideapad
 * Date: 7/1/2018
 * Time: 4:01 AM
 */

use PHPUnit\Framework\TestCase;
require '../assets/FakeEmployer.php';
require '../assets/FakeJob.php';
require '../assets/FakeFormer.php';

class EmployeeModelTest extends TestCase
{
    public static $db;

    protected function setUp()
    {
        self::$db = $this->getMockBuilder("PDO")
            ->setConstructorArgs(['sqlite:memory'])
            ->getMock();

    }

    public function testSearch()
    {
        $lieInfo = array(
            array(
                'JobType' => 'Permanent',
                'CreatedDate' => '20-08-2017',
                'Jobdescription' => 'General manager of Anbessa bus',
                'Joblocation' => 'Gerji mebrat hail infront of totot cultural food house',
                'SkillRequired' => 'people friendly, optimistic',
                'Educationalqualificationrequired' => 'Masters in managment',
                'Employerid' => 01,
                'Jobid' => 01
            ),
            array(
                'JobType' => 'Part-time',
                'CreatedDate' => '02-09-2017',
                'Jobdescription' => 'waitress at kaldis coffee',
                'Joblocation' => 'megenagna zefmesh building first floor',
                'SkillRequired' => 'punctual, good memory',
                'Educationalqualificationrequired' => 'G10 and above',
                'Employerid' => 01,
                'Jobid' => 02
            )
        );

        $fakeEmployer = array(
            'id' => 1,
            'name' => 'Elias',
            'password' => 'Satellite',
            'email' => 'eandualem@gmail.com',
            'phone' => 911099351,
            'country' => 'Ethiopia',
            'region' => 'region',
            'city' => 'AA',
            'address' => '22 Golagul building 2nd floor',
            'active' => 1
        );
        $employer = new FakeEmployer();

        $expectedLies = array();
        $expectedLies[0] = new FakeJob();
        $expectedLies[1] = new FakeJob();

        foreach ($lieInfo as $i => $details) {
            $expectedLies[$i]->JobType = $details['JobType'];
            $expectedLies[$i]->CreatedDate = $details['CreatedDate'];
            $expectedLies[$i]->Joblocation = $details['Joblocation'];
            $expectedLies[$i]->Jobdescription = $details['Jobdescription'];
            $expectedLies[$i]->SkillRequired = $details['SkillRequired'];
            $expectedLies[$i]->Educationalqualificationrequired = $details['Educationalqualificationrequired'];
            $expectedLies[$i]->Employerid = $details['Employerid'];
            $expectedLies[$i]->Jobid = $details['Jobid'];

        }


        foreach ($fakeEmployer as $field => $value) {
            $employer->{$field} = $value;
        }
        $sth = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute','fetchAll'))
            ->getMock();
        $sth->expects($this->once())
            ->method('fetchAll')
            ->will($this->returnValue($expectedLies));
        $sth->expects($this->at(0))
            ->method('execute')
            ->will($this->returnValue(true));
        $sth->expects($this->at(1))
            ->method('execute')
            ->will($this->returnValue(true));


        $sth2 = $this->getMockBuilder('stdClass')
             ->setMethods(array('execute', 'fetch'))
             ->getMock();
        $sth2->method('execute')
             ->will($this->returnValue(true));
        $sth2->method('fetch')
             ->will($this->returnValue($employer));

        self::$db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains("select * from job where email like :inserted_email"))
            ->will($this->returnValue($sth));


        self::$db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains('SELECT * FROM employer WHERE Employerid LIKE \'1\''))
            ->will($this->returnValue($sth2));


        $Employee = new EmployeeModel(self::$db);

        $this->assertEquals(
            $lieInfo,
            $Employee->search('SELECT * FROM job WHERE email LIKE :inserted_email'),
            " "
        );
    }


    public function testApply()
    {
        $_SESSION['userid'] = 1;
        $_POST['JOBID'] = 1;

        $query = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute','rowCount'))
            ->getMock();
        $query->method('execute')
            ->will($this->returnValue(true));
        $query->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(1));

        self::$db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains("INSERT INTO empAppliedJobs (employeeid, Jobid) VALUES ('1', '1')"))
            ->will($this->returnValue($query));

        $Employee = new EmployeeModel(self::$db);

        $this->assertEquals(
            true,
            $Employee->apply(),
            "Employer Didnt log in"
        );
    }
    public function testAccepted()
    {
        $_SESSION['userid'] = 1;


        $fakeJob = array(
            'JobType' => 'Part-time',
            'CreatedDate' => '02-09-2017',
            'Jobdescription' => 'waitress at kaldis coffee',
            'Joblocation' => 'megenagna zefmesh building first floor',
            'SkillRequired' => 'punctual, good memory',
            'Educationalqualificationrequired' => 'G10 and above',
            'Employerid' => 1,
            'Jobid' => 02
        );

        $job = new FakeJob();
        foreach ($fakeJob as $field => $value) {
            $job->{$field} = $value;
        }

        $fakeEmployer = array(
            'id' => 1,
            'name' => 'Elias',
            'password' => 'Satellite',
            'email' => 'eandualem@gmail.com',
            'phone' => 911099351,
            'country' => 'Ethiopia',
            'region' => 'region',
            'city' => 'AA',
            'address' => '22 Golagul building 2nd floor',
            'active' => 1
        );
        $employer = new FakeEmployer();

        foreach ($fakeEmployer as $field => $value) {
            $employer->{$field} = $value;
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
            ->will($this->returnValue($employer));



        self::$db->expects($this->at(0))
             ->method('prepare')
             ->with($this->stringContains("SELECT * FROM empAppliedJobs WHERE employeeid LIKE '1' AND accepted LIKE 'yes'"))
             ->will($this->returnValue($sth));
        self::$db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM employer WHERE Employerid LIKE '1'"))
            ->will($this->returnValue($sth2));

        $temp=array(
            'name' => 'Elias',
            'email' => 'eandualem@gmail.com',
            'phone' => 911099351,
            'country' => 'Ethiopia',
            'city' => 'AA',
            'add' => '22 Golagul building 2nd floor',
            'type' => 'Part-time',
            'cdate' => '02-09-2017',
            'desc' => 'waitress at kaldis coffee',
            'loc' => 'megenagna zefmesh building first floor',
            'skill' => 'punctual, good memory',
            'educ' => 'G10 and above',
            'jobid' => 02);
        $temp = json_encode($temp);
        $exp = array();

        $exp[0] = $temp;
        $Employee = new EmployeeModel(self::$db);

        $this->assertEquals(
            $exp,
            $Employee->accepted(),
            " "
        );
    }

    public function testFormer()
    {
        $_SESSION['userid'] = 1;


        $fakeFormer = new FakeFormer();
        $fakeFormer->Employeeid = 1;
        $fakeFormer->Employerid = 1;

        $fakeJob = array(
            'JobType' => 'Part-time',
            'CreatedDate' => '02-09-2017',
            'Jobdescription' => 'waitress at kaldis coffee',
            'Joblocation' => 'megenagna zefmesh building first floor',
            'SkillRequired' => 'punctual, good memory',
            'Educationalqualificationrequired' => 'G10 and above',
            'Employerid' => 1,
            'Jobid' => 02
        );

        $job = new FakeJob();
        foreach ($fakeJob as $field => $value) {
            $job->{$field} = $value;
        }

        $fakeEmployer = array(
            'id' => 1,
            'name' => 'Elias',
            'password' => 'Satellite',
            'email' => 'eandualem@gmail.com',
            'phone' => 911099351,
            'country' => 'Ethiopia',
            'region' => 'region',
            'city' => 'AA',
            'address' => '22 Golagul building 2nd floor',
            'active' => 1
        );
        $employer = new FakeEmployer();

        foreach ($fakeEmployer as $field => $value) {
            $employer->{$field} = $value;
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
            ->will($this->returnValue($employer));

        $sth3 = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute','fetch'))
            ->getMock();
        $sth3->method('execute')
            ->will($this->returnValue(true));
        $sth3->expects($this->at(0))
            ->method('fetch')
            ->will($this->returnValue($job));
        $sth3->expects($this->at(1))
            ->method('fetch')
            ->will($this->returnValue(0));

        self::$db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM workedtogether WHERE employeeid LIKE '1'"))
            ->will($this->returnValue($sth));
        self::$db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM employer WHERE employerid LIKE '1'"))
            ->will($this->returnValue($sth2));
        self::$db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("SELECT * FROM Job WHERE Employerid LIKE '1'"))
            ->will($this->returnValue($sth3));

        $temp=array(
            'name' => 'Elias',
            'email' => 'eandualem@gmail.com',
            'phone' => 911099351,
            'country' => 'Ethiopia',
            'city' => 'AA',
            'add' => '22 Golagul building 2nd floor',
            'type' => 'Part-time',
            'cdate' => '02-09-2017',
            'desc' => 'waitress at kaldis coffee',
            'loc' => 'megenagna zefmesh building first floor',
            'skill' => 'punctual, good memory',
            'educ' => 'G10 and above',
            'jobid' => 02);
        $temp = json_encode($temp);
        $exp = array();

        $exp[0] = $temp;
        $Employee = new EmployeeModel(self::$db);

        $this->assertEquals(
            $exp,
            $Employee->former(),
            " "
        );
    }


}
