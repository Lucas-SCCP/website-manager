<?php

// tests/Controllers/ReservaControllerTest.php

use PHPUnit\Framework\TestCase;
use App\Controllers\UserController;

class UserControllerTest extends TestCase
{
    public function testGetUsers()
    {
        $controller = new UserController();
        $response = $controller->index();

        $this->assertEquals('teste', $response);
    }
}
