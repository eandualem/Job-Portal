<?php
/**
 * Created by PhpStorm.
 * User: jobportal
 * Date: 7/1/18
 * Time: 10:29 AM
 */

use PHPUnit\Framework\TestCase;

class searchTest extends TestCase
{
    public static $db;
    public static $jobInfo;

    protected function setUp()
    {
        self::$db = $this->getMockBuilder("PDO")
            ->setConstructorArgs(['sqlite:memory'])
            ->getMock();

        self::$jobInfo = array(
            array(
                'type' => 'Partime',
                'cdate' => '8-8-2018',
                'desc' => 'New Job',
                'loc' => 'Addis Abeba',
                'skill' => 'Programer',
                'educ' => 'Software Engineer',
                'jobid' => 1,
                'name' => 'Web Developer',
                'country' => 'Ethiopia',
                'city' => 'Addis Abeba',
                'add' => '4Kilo',
                'email' => 'eandualem@gmail.com',
                'phone' => 911099351,
            ),
            array(
                'type' => 'Full Time',
                'cdate' => '8-8-2018',
                'desc' => 'Web Designer',
                'loc' => 'Addis Abeba',
                'skill' => 'Programer',
                'educ' => 'Software Engineer',
                'jobid' => 2,
                'name' => 'Web Developer',
                'country' => 'Ethiopia',
                'city' => 'Addis Abeba',
                'add' => '4Kilo',
                'email' => 'eandualem@gmail.com',
                'phone' => 911099351,
            ),
        );
    }

    public function testSearch()
    {
        $_POST["num_result"] = 4;
        $_POST["search_table"] = 'employee';
        $_POST["JobType"] = 'Part Time';
        $_POST["Location"] = 'Addis Abeba';
        $_POST["SkillRequired"] = "Software Engineer";
        $_POST["EdQl"] = "Degree";

        $search_model = $this->getMockBuilder('EmployeeModel')
            ->setMethods(array('__construct', 'search'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $search_model->expects($this->once())
            ->method('search')
            ->will($this->returnValue(self::$jobInfo));

        $search = $this->getMockBuilder('search')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["search"])
            ->getMock();

        $search->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('employee'))
            ->will($this->returnValue($search_model));

        $search->search();
        $this->expectException("Fatal error: require(): Failed opening required 'application/controllers/employee/employee.php'");


    }

    public function testApply()
    {
        $search_model = $this->getMockBuilder('EmployeeModel')
            ->setMethods(array('__construct', 'apply'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $search_model->expects($this->once())
            ->method('apply')
            ->will($this->returnValue(true));

        $search = $this->getMockBuilder('search')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["apply"])
            ->getMock();

        $search->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('employee'))
            ->will($this->returnValue($search_model));

        $search->apply();
        $this->expectException("Error rendering result");
    }

    public function testAccepted()
    {
        $search_model = $this->getMockBuilder('EmployeeModel')
            ->setMethods(array('__construct', 'accepted'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $search_model->expects($this->once())
            ->method('accepted')
            ->will($this->returnValue("zelalem"));

        $search = $this->getMockBuilder('search')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["accepted"])
            ->getMock();

        $search->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('employee'))
            ->will($this->returnValue($search_model));

        $search->accepted();
        $this->expectException("Error rendering result");
    }

    public function testFormer()
    {
        $search_model = $this->getMockBuilder('EmployeeModel')
            ->setMethods(array('__construct', 'former'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $search_model->expects($this->once())
            ->method('former')
            ->will($this->returnValue("zelalem"));

        $search = $this->getMockBuilder('search')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["former"])
            ->getMock();

        $search->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('employee'))
            ->will($this->returnValue($search_model));

        $search->former();
        $this->expectException("Error rendering result");

    }
}
