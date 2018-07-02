<?php
/**
 * Created by PhpStorm.
 * User: jobportal
 * Date: 6/28/18
 * Time: 3:45 AM
 */

use PHPUnit\ExampleExtension\TestCaseTrait;
use PHPUnit\Framework\TestCase;
require '../assets/FakeEmployerObject.php';
require '../assets/FakeEmployeeObject.php';

class LoginModelTest extends TestCase
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
            ->setMethods(array('__construct'))
            ->setConstructorArgs(array(self::$db))
            ->setMethodsExcept(["login"])
            ->getMock();
        $loginModel->method('login_employee')
            ->will($this->onConsecutiveCalls(true, false));
        $loginModel->method('login_employer')
            ->will($this->onConsecutiveCalls(true, false));

        $_POST['Email'] = "eandualem@gmail.com";
        $_POST['password'] = "Satellite";

        $_POST['UserType'] = "employee";
        $this->assertSame("employee", $loginModel->login());
        $this->assertSame("false", $loginModel->login());


        $_POST['UserType'] = "employer";
        $this->assertSame("employer", $loginModel->login());
        $this->assertSame("false", $loginModel->login());

    }

    public function testLoginEmployee()
    {
        $lieEmployee = array(
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
        $employee = new FakeEmployeeObject();

        foreach ($lieEmployee as $field => $value) {
            $employee->{$field} = $value;
        }

        $sth = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'rowCount', 'fetch'))
            ->getMock();
        $sth->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(true));
        $sth->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(1));
        $sth->expects($this->once())
            ->method('fetch')
            ->will($this->returnValue($employee));

        $db = $this->getMockBuilder('PDOMock')
            ->setMethods(array('prepare'))
            ->getMock();
        $db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains('SELECT * FROM employee WHERE email LIKE :inserted_email'))
            ->will($this->returnValue($sth));

        $login = new LoginModel($db);

        $this->assertEquals(
            true,
            $login->login_employee('eandualem@gmail.com', 'Satellite'),
            "Employer Didnt log in"
        );
    }

    public function testLoginEmployer()
    {
        $lieEmployer = array(
            'name' => 'Elias',
            'password' => 'Satellite',
            'email' => 'eandualem@gmail.com',
            'country' => 'Ethiopia',
            'region' => 'region',
            'city' => 'AA',
            'address' => '4Kilo',
            'phone' => 911099351,
            'active' => 0
        );
        $employer = new FakeEmployerObject();

        foreach ($lieEmployer as $field => $value) {
            $employer->{$field} = $value;
        }

        $sth = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'rowCount', 'fetch'))
            ->getMock();
        $sth->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(true));
        $sth->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(1));
        $sth->expects($this->once())
            ->method('fetch')
            ->will($this->returnValue($employer));

        $db = $this->getMockBuilder('PDOMock')
            ->setMethods(array('prepare'))
            ->getMock();
        $db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains('SELECT * FROM employer WHERE email LIKE :inserted_email'))
            ->will($this->returnValue($sth));


        $login = new LoginModel($db);

        $this->assertEquals(
            true,
            $login->login_employer('eandualem@gmail.com', 'Satellite'),
            "Employer Didnt log in"
        );

    }

    public function testCreateEmployee()
    {
        $lieEmployee = array(
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
        $employee = new FakeEmployeeObject();

        foreach ($lieEmployee as $field => $value) {
            $employee->{$field} = $value;
        }

        // Mock our PDO statement
        $sth = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'rowCount'))
            ->getMock();
        $sth->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(true));
        $sth->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(0));

        $sth2 = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'rowCount'))
            ->getMock();
        $sth2->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(true));

        $sth2->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(1));

        $db = $this->getMockBuilder('PDOMock')
            ->setMethods(array('prepare'))
            ->getMock();
        $db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains('SELECT * FROM employee WHERE email LIKE :inserted_email '))
            ->will($this->returnValue($sth));
        $db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("insert into employee (name, password, email, age, sex, phone, postal, country, region, city, address, about, active)
                            values (:name, :password, :email, :age, :sex, :phone, :postal, :country, :region, :city, :address, :about, :active)"))
            ->will($this->returnValue($sth2));

        $login = new LoginModel($db);

        $this->assertEquals(
            true,
            $login->create_employee($employee),
            "Employer Didnt log in"
        );
    }

    public function testCreateEmployer()
    {
        $lieEmployer = array(
            'name' => 'Elias',
            'password' => 'Satellite',
            'email' => 'eandualem@gmail.com',
            'country' => 'Ethiopia',
            'region' => 'region',
            'city' => 'AA',
            'address' => '4Kilo',
            'phone' => 911099351,
            'active' => 0
        );
        $employer = new FakeEmployerObject();

        foreach ($lieEmployer as $field => $value) {
            $employer->{$field} = $value;
        }

        // Mock our PDO statement
        $sth = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'rowCount'))
            ->getMock();
        $sth->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(true));
        $sth->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(0));

        $sth2 = $this->getMockBuilder('stdClass')
            ->setMethods(array('execute', 'rowCount'))
            ->getMock();
        $sth2->expects($this->once())
            ->method('execute')
            ->will($this->returnValue(true));

        $sth2->expects($this->once())
            ->method('rowCount')
            ->will($this->returnValue(1));

        $db = $this->getMockBuilder('PDOMock')
            ->setMethods(array('prepare'))
            ->getMock();
        $db->expects($this->at(0))
            ->method('prepare')
            ->with($this->stringContains('SELECT * FROM employer WHERE email LIKE :inserted_email '))
            ->will($this->returnValue($sth));
        $db->expects($this->at(1))
            ->method('prepare')
            ->with($this->stringContains("INSERT INTO employer (name, password, email, country, region, city, address, phone, active)
                          VALUES (:name, :password, :email, :country, :region, :city, :address, :phone, :active)"))
            ->will($this->returnValue($sth2));

        $login = new LoginModel($db);

        $this->assertEquals(
            true,
            $login->create_employer($employer),
            "Employer Didnt log in"
        );
    }
}