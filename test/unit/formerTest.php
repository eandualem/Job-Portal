<?php
/**
 * Created by PhpStorm.
 * User: jobportal
 * Date: 7/1/18
 * Time: 10:28 AM
 */

use PHPUnit\Framework\TestCase;
require '../../assets/FakeEmployeeObject.php';

class formerTest extends TestCase
{

    public static $db;
    public static $sampleEmployeeInfo;
    protected function setUp()
    {
        self::$db = $this->getMockBuilder("PDO")
            ->setConstructorArgs(['sqlite:memory'])
            ->getMock();

        self::$sampleEmployeeInfo = array(
            array(
                'name' => 'Elias Andualem',
                'country' => 'Ethiopia',
                'city' => 'Addis Abeba',
                'add' => '4Kilo',
                'email' => 'eanduale@gmail.com',
                'phone' => '0911099351'
            ),
            array(
                'name' => 'New name',
                'country' => 'Ethiopia',
                'city' => 'Addis Abeba',
                'add' => '6Kilo',
                'email' => 'e@gmail.com',
                'phone' => '0918099351'
            ),
        );
    }

    public function testFormer_employee()
    {
        $employeeList = array();
        $employeeList[0] = new FakeEmployeeObject();
        $employeeList[1] = new FakeEmployeeObject();

        foreach (self::$sampleEmployeeInfo as $i => $details) {
            $employeeList[$i]->name = $details['name'];
            $employeeList[$i]->country = $details['country'];
            $employeeList[$i]->city = $details['city'];
            $employeeList[$i]->add = $details['add'];
            $employeeList[$i]->email = $details['email'];
            $employeeList[$i]->phone = $details['phone'];
        }



        $employer_model = $this->getMockBuilder('EmployerModel')
            ->setMethods(array('__construct', 'former'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $employer_model->expects($this->once())
            ->method('former')
            ->will($this->returnValue(self::$sampleEmployeeInfo));

        $former = $this->getMockBuilder('former')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["former_employee"])
            ->getMock();

        $former->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('employer'))
            ->will($this->returnValue($employer_model));



        $former->former_employee();
        $this->expectException("Error rendering result");
    }
}
