<?php
/**
 * Created by PhpStorm.
 * User: jobportal
 * Date: 7/1/18
 * Time: 10:18 AM
 */

use PHPUnit\Framework\TestCase;

class register_employerTest extends TestCase
{
    public static $db;
    protected function setUp()
    {
        self::$db = $this->getMockBuilder("PDO")
            ->setConstructorArgs(['sqlite:memory'])
            ->getMock();
    }

    public function testRegister()
    {
        $loginModel = $this->getMockBuilder('LoginModel')
            ->setMethods(array('__construct', 'create_employer'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();
        $loginModel->method('create_employer')
            ->will($this->onConsecutiveCalls(true, false));

        $register_employer = $this->getMockBuilder('register_employer')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["register"])
            ->getMock();

        $register_employer->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('Login'))
            ->will($this->returnValue($loginModel));

        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['UserName'] = "Elais";
        $_POST['Password'] = "Satellite";
        $_POST['email'] = "eandualem@gmail.com";
        $_POST['DateOfBirth'] = '1996';
        $_POST['Sex'] = 'M';
        $_POST['Phone'] = 911099351;
        $_POST['Postal'] = 1122;
        $_POST['Country'] = "Ethiopia";
        $_POST['Region'] = "Region";
        $_POST['City'] = 'City';
        $_POST['Address'] = 'Address';
        $_POST['AboutMe'] = 'AboutMe';

        $this->assertSame(true, $register_employer->register());

        $this->assertSame(true, $register_employer->register());
    }
}
