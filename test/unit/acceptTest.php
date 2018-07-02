<?php
/**
 * Created by PhpStorm.
 * User: jobportal
 * Date: 7/1/18
 * Time: 10:27 AM
 */

use PHPUnit\Framework\TestCase;

class acceptTest extends TestCase
{
    public static $db;
    public static $sampleAppliedEmployees;
    protected function setUp()
    {
        self::$db = $this->getMockBuilder("PDO")
            ->setConstructorArgs(['sqlite:memory'])
            ->getMock();

        self::$sampleAppliedEmployees = array(
            array('name' => 'Elias', 'country' => "Ethiopia", 'city' => "AA", 'add' => "4K",
                'email' => "eandualem@gmail.com", 'phone' => 911099351, 'jobid' => 2, 'certificate' => "degree",
                'major' => "Software Eng", 'institute' => "AAIT", 'stdate' => "9-9-2013", 'codate' => "9-9-2017", 'gpa' => '4:00'),
            array('name' => 'Elias', 'country' => "Ethiopia", 'city' => "AA", 'add' => "4K",
                'email' => "eandualem@gmail.com", 'phone' => 911099351, 'jobid' => 2, 'certificate' => "degree",
                'major' => "Software Eng", 'institute' => "AAIT", 'stdate' => "9-9-2013", 'codate' => "9-9-2017", 'gpa' => '4:00'),
        );
    }

    public function testAccept()
    {
        $employer_model = $this->getMockBuilder('EmployerModel')
            ->setMethods(array('__construct', 'accept'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $employer_model->expects($this->once())
            ->method('accept')
            ->will($this->returnValue(json_encode(self::$sampleAppliedEmployees)));

        $accept = $this->getMockBuilder('accept')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["accept"])
            ->getMock();

        $accept->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('Employer'))
            ->will($this->returnValue($employer_model));

        $accept->accept();
        $this->expectException("Error rendering result");
    }
}
