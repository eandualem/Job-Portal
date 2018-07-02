<?php
/**
 * Created by PhpStorm.
 * User: jobportal
 * Date: 6/30/18
 * Time: 7:45 AM
 */

use PHPUnit\Framework\TestCase;

class loginTest extends TestCase
{
    public static $db;
    protected function setUp()
    {
        self::$db = $this->getMockBuilder("PDO")
            ->setConstructorArgs(['sqlite:memory'])
            ->getMock();
    }

    public function testLogin()
    {
        $loginModel = $this->getMockBuilder('LoginModel')
            ->setMethods(array('__construct', 'login'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $loginModel->expects($this->once())
            ->method('login')
            ->will($this->returnValue("employee"));

        $login = $this->getMockBuilder('login')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["login"])
            ->getMock();

        $login->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('Login'))
            ->will($this->returnValue($loginModel));

        $login->login();
        $this->expectException("Fatal error: require(): Failed opening required 'application/controllers/employee/employee.php'");
    }

    public function testLogout()
    {
        $loginModel = $this->getMockBuilder('LoginModel')
            ->setMethods(array('__construct', 'logout'))
            ->setConstructorArgs(array(self::$db))
            ->getMock();

        $loginModel->expects($this->once())
            ->method('logout')
            ->will($this->returnValue(true));

        $login = $this->getMockBuilder('login')
            ->disableOriginalConstructor()
            ->setMethodsExcept(["login"])
            ->getMock();

        $login->expects($this->once())
            ->method('loadModel')
            ->with($this->stringContains('Login'))
            ->will($this->returnValue($loginModel));

        $login->logout();
        $this->expectException("Error rendering result");

    }

    public function test__construct()
    {

    }
}
