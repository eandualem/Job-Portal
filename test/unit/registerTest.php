<?php
/**
 * User: jobportal
 * Date: 7/1/18
 * Time: 11:21 AM
 */

use PHPUnit\Framework\TestCase;

class registerTest extends TestCase
{

    public function testRegister()
    {
        $register = new register();
        $_SERVER['REQUEST_METHOD'] = 'POST';
        $_POST['UserType'] = "employee";
        $this->assertSame(true, $register->register());

        $_POST['UserType'] = "employer";
        $this->assertSame(true, $register->register());

        $_SERVER['REQUEST_METHOD'] = '';
        $this->assertSame(false, $register->register());
    }
}
